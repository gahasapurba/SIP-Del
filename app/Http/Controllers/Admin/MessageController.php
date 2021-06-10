<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use Hashids\Hashids;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function restore($id)
    {
        $hash = new Hashids('', 10);

        $item = Message::withTrashed()->where('id', $hash->decodeHex($id))->first();

        $item->restore();

        return redirect()->route('admin-trash')->with('success', 'Pesan Berhasil Direstore!');
    }

    public function kill($id)
    {
        $hash = new Hashids('', 10);

        $item = Message::withTrashed()->where('id', $hash->decodeHex($id))->first();

        $item->forceDelete();

        return redirect()->route('admin-trash')->with('success', 'Pesan Berhasil Dihapus Permanen!');
    }
}
