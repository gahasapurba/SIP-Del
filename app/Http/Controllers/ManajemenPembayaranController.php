<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PurchaseRequest;
use App\Purchase;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ManajemenPembayaranController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $query = Purchase::query()->with('author', 'category');
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
                                    <a class="dropdown-item" href="' . route('manajemenpembayaran.edit', $hash->encodeHex($item->id)) . '">
                                        Edit
                                    </a>
                                    <button class="dropdown-item text-danger remove-purchasing" data-id="{{ $hash->encodeHex($item->id) }}" data-action="'. route('manajemenpembayaran.destroy', $hash->encodeHex($item->id)) .'">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('author', function (Purchase $purchase) {
                    return $purchase->author->name;
                })
                ->addColumn('category', function (Purchase $purchase) {
                    return $purchase->category->name;
                })
                ->addColumn('price', function (Purchase $purchase) {
                    return 'Rp' . number_format($purchase->price,2,",",".");
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make();
        }

        $hash = new Hashids('', 10);

        return view('pages.purchase-index', [
            'hash' => $hash,
        ]);
    }

    public function create()
    {
        $category = Category::all();
        $hash = new Hashids('', 10);

        return view('pages.purchase-create',[
            'categories' => $category,
            'hash' => $hash,
        ]);
    }

    public function store(PurchaseRequest $request)
    {
        $data = [
            'users_id' => $request->users_id,
            'categories_id' => $request->categories_id,
            'title' => $request->title,
            'company_name' => $request->company_name,
            'price' => 0,
            'description' => $request->description,
        ];

        $hash = new Hashids('', 10);

        $data['categories_id'] = $hash->decodeHex($request->categories_id);

        Purchase::create($data);

        return redirect()->route('manajemenpembayaran.index')->with('success', 'Pembayaran Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $hash = new Hashids('', 10);
        $item = Purchase::findOrFail($hash->decodeHex($id));
        $category = Category::all();
        
        return view('pages.purchase-edit', [
            'hash' => $hash,
            'item' => $item,
            'categories' => $category
        ]);
    }

    public function update(PurchaseRequest $request, $id)
    {
        $hash = new Hashids('', 10);

        $data = $request->all();

        $data['categories_id'] = $hash->decodeHex($request->categories_id);

        $item = Purchase::findOrFail($hash->decodeHex($id));

        $item->update($data);

        return redirect()->route('manajemenpembayaran.index')->with('success', 'Pembayaran Berhasil Diedit!');
    }

    public function destroy($id)
    {
        $hash = new Hashids('', 10);

        $item = Purchase::findOrFail($hash->decodeHex($id));

        $item->delete();

        return redirect()->route('manajemenpembayaran.index')->with('success', 'Pembayaran Berhasil Dihapus!');
    }
}
