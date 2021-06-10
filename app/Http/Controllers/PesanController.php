<?php

namespace App\Http\Controllers;

use App\Http\Requests\PesanRequest;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Hashids\Hashids;

class PesanController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $query = Message::with('receiver')->where('users_id', Auth::user()->id);
            $hash = new Hashids('', 10);

            return DataTables::of($query)
                ->addColumn('action', function($item) use($hash) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('pesan.edit', $hash->encodeHex($item->id)) . '">
                                        Edit
                                    </a>
                                    <button class="dropdown-item text-danger remove-message" data-id="{{ $hash->encodeHex($item->id) }}" data-action="'. route('pesan.destroy', $hash->encodeHex($item->id)) .'">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('receiver', function (Message $message) {
                    return $message->receiver->name;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make();
        }

        $item = Message::with('sender')->latest()->where('receiver_users_id', Auth::user()->id)->paginate(5);
        $hash = new Hashids('', 10);

        return view('pages.message-index', [
            'items' => $item,
            'hash' => $hash,
        ]);
    }

    public function create()
    {
        $user = User::all()->whereNotIn('id', Auth::user()->id);
        $hash = new Hashids('', 10);

        return view('pages.message-create',[
            'users' => $user,
            'hash' => $hash,
        ]);
    }

    public function store(PesanRequest $request)
    {
        $hash = new Hashids('', 10);

        if ($request->hasFile('file')) {
            $data = [
                'users_id' => Auth::user()->id,
                'receiver_users_id' => $hash->decodeHex($request->receiver_users_id),
                'content' => $request->content,
                'file' => $request->file,
            ];

            $data['file'] = $request->file('file')->store('assets/file','public');

            Message::create($data);
        } else {
            Message::create([
                'users_id' => Auth::user()->id,
                'receiver_users_id' => $hash->decodeHex($request->receiver_users_id),
                'content' => $request->content,
            ]);
        }

        return redirect()->route('pesan.index')->with('success', 'Pesan Berhasil Dikirim!');
    }

    public function edit($id)
    {
        $hash = new Hashids('', 10);
        $item = Message::where('users_id', Auth::user()->id)->findOrFail($hash->decodeHex($id));
        $user = User::all()->whereNotIn('id', Auth::user()->id);
        
        return view('pages.message-edit', [
            'item' => $item,
            'users' => $user,
            'hash' => $hash,
        ]);
    }

    public function show($id)
    {
        $hash = new Hashids('', 10);
        $item = Message::with('receiver')->where('receiver_users_id', Auth::user()->id)->findOrFail($hash->decodeHex($id));
        
        return view('pages.message-detail', [
            'item' => $item,
        ]);
    }

    public function search(Request $request)
    {
        $find = $request->search;

        $hash = new Hashids('', 10);
        $item = Message::with('sender')->latest()->where('receiver_users_id', Auth::user()->id)->whereHas('sender', function ($query) use ($find) {
            $query->where('name', 'like', '%' . $find . '%');
        })->paginate(5);
        
        return view('pages.message-index', [
            'items' => $item,
            'hash' => $hash,
        ]);
    }

    public function update(PesanRequest $request, $id)
    {
        $hash = new Hashids('', 10);

        if ($request->hasFile('file')) {
            $data = [
                'users_id' => Auth::user()->id,
                'receiver_users_id' => $hash->decodeHex($request->receiver_users_id),
                'content' => $request->content,
                'file' => $request->file,
            ];

            $item = Message::where('users_id', Auth::user()->id)->findOrFail($hash->decodeHex($id));

            $data['file'] = $request->file('file')->store('assets/file','public');
        } else {
            $data = [
                'users_id' => Auth::user()->id,
                'receiver_users_id' => $hash->decodeHex($request->receiver_users_id),
                'content' => $request->content,
            ];

            $item = Message::where('users_id', Auth::user()->id)->findOrFail($hash->decodeHex($id));
        }

        $item->update($data);

        return redirect()->route('pesan.index')->with('success', 'Pesan Berhasil Diedit!');
    }

    public function destroy($id)
    {
        $hash = new Hashids('', 10);

        $item = Message::where('users_id', Auth::user()->id)->findOrFail($hash->decodeHex($id));

        $item->delete();

        return redirect()->route('pesan.index')->with('success', 'Pesan Berhasil Dihapus!');
    }
}
