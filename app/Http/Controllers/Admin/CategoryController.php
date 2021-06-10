<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $query = Category::query();
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
                                    <a class="dropdown-item" href="' . route('category.edit', $hash->encodeHex($item->id)) . '">
                                        Edit
                                    </a>
                                    <button class="dropdown-item text-danger remove-category" data-id="{{ $hash->encodeHex($item->id) }}" data-action="'. route('category.destroy', $hash->encodeHex($item->id)) .'">
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

        return view('pages.admin.category.index');
    }

    public function create()
    {
        return view('pages.admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        Category::create($data);

        return redirect()->route('category.index')->with('success', 'Kategori Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $hash = new Hashids('', 10);
        $item = Category::findOrFail($hash->decodeHex($id));
        
        return view('pages.admin.category.edit', [
            'item' => $item,
            'hash' => $hash,
        ]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $hash = new Hashids('', 10);

        $data = $request->all();

        $item = Category::findOrFail($hash->decodeHex($id));

        $item->update($data);

        return redirect()->route('category.index')->with('success', 'Kategori Berhasil Diedit!');
    }

    public function destroy($id)
    {
        $hash = new Hashids('', 10);

        $item = Category::findOrFail($hash->decodeHex($id));

        $item->delete();

        return redirect()->route('category.index')->with('success', 'Kategori Berhasil Dihapus!');
    }

    public function restore($id)
    {
        $hash = new Hashids('', 10);

        $item = Category::withTrashed()->where('id', $hash->decodeHex($id))->first();

        $item->restore();

        return redirect()->route('admin-trash')->with('success', 'Kategori Berhasil Direstore!');
    }

    public function kill($id)
    {
        $hash = new Hashids('', 10);

        $item = Category::withTrashed()->where('id', $hash->decodeHex($id))->first();

        $item->forceDelete();

        return redirect()->route('admin-trash')->with('success', 'Kategori Berhasil Dihapus Permanen!');
    }
}
