<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Http\Requests\PurchaseRequest;
use App\Item;
use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Hashids\Hashids;

class PembayaranController extends Controller
{
    public function index()
    {
        $unpaid = Purchase::latest()->where('purchasing_status', 'belum')->paginate(5);
        $unpaid->appends(['category' => 'unpaid']);

        $paid = Purchase::latest()->where('purchasing_status', 'sudah')->paginate(5);
        $paid->appends(['category' => 'paid']);

        $hash = new Hashids('', 10);
        
        return view('pages.purchase-list', [
            'unpaids' => $unpaid,
            'paids' => $paid,
            'hash' => $hash,
        ]);
    }

    public function show($id)
    {
        $hash = new Hashids('', 10);

        $item = Purchase::with('category', 'items')->findOrFail($hash->decodeHex($id));
        
        return view('pages.purchase-detail', [
            'item' => $item,
            'hash' => $hash,
        ]);
    }

    public function search(Request $request)
    {
        $unpaid = Purchase::latest()->where('title', 'like', '%' . $request->search . '%')->where('purchasing_status', 'belum')->paginate(5);
        $unpaid->appends(['category' => 'unpaid']);

        $paid = Purchase::latest()->where('title', 'like', '%' . $request->search . '%')->where('purchasing_status', 'sudah')->paginate(5);
        $paid->appends(['category' => 'paid']);

        $hash = new Hashids('', 10);
        
        return view('pages.purchase-list', [
            'unpaids' => $unpaid,
            'paids' => $paid,
            'hash' => $hash,
        ]);
    }

    public function updatePembayaran(PurchaseRequest $request, $id)
    {
        $hash = new Hashids('', 10);

        $data = $request->all();

        $data['categories_id'] = $hash->decodeHex($request->categories_id);
        $data['users_id'] = $hash->decodeHex($request->users_id);

        $item = Purchase::findOrFail($hash->decodeHex($id));

        $data['payment_slip'] = $request->file('payment_slip')->store('assets/payment_slip','public');

        $item->update($data);

        return redirect()->back()->with('success', 'Pembayaran Berhasil Diupdate!');
    }

    public function invoice($id)
    {
        $hash = new Hashids('', 10);

        $item = Purchase::with(['author', 'category', 'items'])->findOrFail($hash->decodeHex($id));
        
        $pdf = PDF::loadView('pages.purchase-invoice', [
            'item' => $item,
            'hash' => $hash,
        ])->setOptions(['defaultFont' => 'Poppins']);

        return $pdf->stream('SIP-Del-Invoice-' . $item->title . '.pdf');
    }

    public function addItem(ItemRequest $request)
    {
        $data = [
            'purchases_id' => $request->purchases_id,
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price_per_item' => $request->price_per_item,
            'price_total_item' => $request->price_per_item * $request->quantity,
        ];

        Item::create($data);

        return redirect()->back()->with('success', 'Item Berhasil Ditambahkan Ke Pembelian Ini!');
    }

    public function editItem($id)
    {
        $hash = new Hashids('', 10);
        $item = Item::findOrFail($hash->decodeHex($id));
        
        return view('pages.purchase-item-edit', [
            'hash' => $hash,
            'item' => $item,
        ]);
    }

    public function updateItem(ItemRequest $request, $id)
    {
        $hash = new Hashids('', 10);

        $data = [
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price_per_item' => $request->price_per_item,
            'price_total_item' => $request->price_per_item * $request->quantity,
        ];

        $item = Item::findOrFail($hash->decodeHex($id));

        $item->update($data);

        return redirect()->route('pembayaran.index')->with('success', 'Item Di Pembelian Ini Berhasil Diedit!');
    }

    public function deleteItem($id)
    {
        $hash = new Hashids('', 10);

        $item = Item::findOrFail($hash->decodeHex($id));

        $item->delete();

        return redirect()->back()->with('success', 'Item Berhasil Dihapus Dari Pembelian Ini!');
    }
}
