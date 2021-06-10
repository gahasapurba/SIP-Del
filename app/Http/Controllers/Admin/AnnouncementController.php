<?php

namespace App\Http\Controllers\Admin;

use App\Announcement;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AnnouncementRequest;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AnnouncementController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $query = Announcement::query();
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
                                    <a class="dropdown-item" href="' . route('announcement.edit', $hash->encodeHex($item->id)) . '">
                                        Edit
                                    </a>
                                    <button class="dropdown-item text-danger remove-announcement" data-id="{{ $hash->encodeHex($item->id) }}" data-action="'. route('announcement.destroy', $hash->encodeHex($item->id)) .'">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.admin.announcement.index');
    }

    public function create()
    {
        return view('pages.admin.announcement.create');
    }

    public function store(AnnouncementRequest $request)
    {
        if ($request->hasFile('file')) {
            $data = $request->all();

            $data['file'] = $request->file('file')->store('assets/file','public');

            Announcement::create($data);
        } else {
            Announcement::create([
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }

        return redirect()->route('announcement.index')->with('success', 'Pengumuman Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $hash = new Hashids('', 10);
        $item = Announcement::findOrFail($hash->decodeHex($id));
        
        return view('pages.admin.announcement.edit', [
            'item' => $item,
            'hash' => $hash,
        ]);
    }

    public function update(AnnouncementRequest $request, $id)
    {
        $hash = new Hashids('', 10);

        if ($request->hasFile('file')) {
            $data = $request->all();

            $item = Announcement::findOrFail($hash->decodeHex($id));

            $data['file'] = $request->file('file')->store('assets/file','public');
        } else {
            $data = [
                'title' => $request->title,
                'content' => $request->content,
            ];

            $item = Announcement::findOrFail($hash->decodeHex($id));
        }

        $item->update($data);

        return redirect()->route('announcement.index')->with('success', 'Pengumuman Berhasil Diedit!');
    }

    public function destroy($id)
    {
        $hash = new Hashids('', 10);

        $item = Announcement::findOrFail($hash->decodeHex($id));

        $item->delete();

        return redirect()->route('announcement.index')->with('success', 'Pengumuman Berhasil Dihapus!');
    }

    public function restore($id)
    {
        $hash = new Hashids('', 10);

        $item = Announcement::withTrashed()->where('id', $hash->decodeHex($id))->first();

        $item->restore();

        return redirect()->route('admin-trash')->with('success', 'Pengumuman Berhasil Direstore!');
    }

    public function kill($id)
    {
        $hash = new Hashids('', 10);

        $item = Announcement::withTrashed()->where('id', $hash->decodeHex($id))->first();

        $item->forceDelete();

        return redirect()->route('admin-trash')->with('success', 'Pengumuman Berhasil Dihapus Permanen!');
    }
}
