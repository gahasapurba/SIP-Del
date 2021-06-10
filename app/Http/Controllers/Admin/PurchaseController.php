<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Item;
use App\Purchase;
use Hashids\Hashids;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function restore($id)
    {
        $hash = new Hashids('', 10);

        $item = Purchase::withTrashed()->where('id', $hash->decodeHex($id))->first();

        $item->restore();

        return redirect()->route('admin-trash')->with('success', 'Pembelian Berhasil Direstore!');
    }

    public function kill($id)
    {
        $hash = new Hashids('', 10);

        $item = Purchase::withTrashed()->where('id', $hash->decodeHex($id))->first();

        $item->forceDelete();

        return redirect()->route('admin-trash')->with('success', 'Pembelian Berhasil Dihapus Permanen!');
    }
    
    public function restoreItem($id)
    {
        $hash = new Hashids('', 10);

        $item = Item::withTrashed()->where('id', $hash->decodeHex($id))->first();

        $item->restore();

        return redirect()->route('admin-trash')->with('success', 'Item Pembelian Berhasil Direstore!');
    }

    public function killItem($id)
    {
        $hash = new Hashids('', 10);

        $item = Item::withTrashed()->where('id', $hash->decodeHex($id))->first();

        $item->forceDelete();

        return redirect()->route('admin-trash')->with('success', 'Item Pembelian Berhasil Dihapus Permanen!');
    }
}
