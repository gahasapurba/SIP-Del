<?php

namespace App\Http\Controllers;

use App\Announcement;
use Hashids\Hashids;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $item = Announcement::latest()->paginate(5);
        $hash = new Hashids('', 10);
        
        return view('pages.announcement-index', [
            'items' => $item,
            'hash' => $hash,
        ]);
    }

    public function show($id)
    {
        $hash = new Hashids('', 10);
        $item = Announcement::findOrFail($hash->decodeHex($id));
        
        return view('pages.announcement-detail', [
            'item' => $item,
        ]);
    }

    public function search(Request $request)
    {
        $item = Announcement::where('title', $request->search)->orWhere('title', 'like', '%' . $request->search . '%')->paginate(5);
        $hash = new Hashids('', 10);
        
        return view('pages.announcement-index', [
            'items' => $item,
            'hash' => $hash,
        ]);
    }
}
