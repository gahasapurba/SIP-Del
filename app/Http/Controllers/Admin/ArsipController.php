<?php

namespace App\Http\Controllers\Admin;

use App\Announcement;
use App\Category;
use App\User;
use App\Http\Controllers\Controller;
use App\Item;
use App\Message;
use App\Purchase;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ArsipController extends Controller
{
    public function trash()
    {
        return view('pages.admin.arsip');
    }

    public function trashKategori()
    {
        if(request()->ajax())
        {
            $queryKategori = Category::onlyTrashed();
            $hash = new Hashids('', 10);

            return DataTables::of($queryKategori)
                ->addColumn('action', function($item) use ($hash) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('category.restore', $hash->encodeHex($item->id)) . '">
                                        Restore
                                    </a>
                                    <button class="dropdown-item text-danger kill-category" data-id="{{ $hash->encodeHex($item->id) }}" data-action="'. route('category.kill', $hash->encodeHex($item->id)) .'">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('deleted_at', function (Category $category) {
                    return $category->deleted_at->isoFormat('dddd, D MMMM Y, HH:mm:ss');
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function trashPengumuman()
    {
        if(request()->ajax())
        {
            $queryPengumuman = Announcement::onlyTrashed();
            $hash = new Hashids('', 10);

            return DataTables::of($queryPengumuman)
                ->addColumn('action', function($item) use($hash) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('announcement.restore', $hash->encodeHex($item->id)) . '">
                                        Restore
                                    </a>
                                    <button class="dropdown-item text-danger kill-announcement" data-id="{{ $hash->encodeHex($item->id) }}" data-action="'. route('announcement.kill', $hash->encodeHex($item->id)) .'">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('deleted_at', function (Announcement $announcement) {
                    return $announcement->deleted_at->isoFormat('dddd, D MMMM Y, HH:mm:ss');
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function trashPembayaran()
    {
        if(request()->ajax())
        {
            $queryPembayaran = Purchase::onlyTrashed()->with('author', 'category');
            $hash = new Hashids('', 10);

            return DataTables::of($queryPembayaran)
                ->addColumn('action', function($item) use($hash) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('purchase.restore', $hash->encodeHex($item->id)) . '">
                                        Restore
                                    </a>
                                    <button class="dropdown-item text-danger kill-purchasing" data-id="{{ $hash->encodeHex($item->id) }}" data-action="'. route('purchase.kill', $hash->encodeHex($item->id)) .'">
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
                ->addColumn('deleted_at', function (Purchase $purchase) {
                    return $purchase->deleted_at->isoFormat('dddd, D MMMM Y, HH:mm:ss');
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make();
        }
    }
    
    public function trashItem()
    {
        if(request()->ajax())
        {
            $queryItem = Item::onlyTrashed()->with('purchase');
            $hash = new Hashids('', 10);

            return DataTables::of($queryItem)
                ->addColumn('action', function($item) use($hash) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('purchase.restoreItem', $hash->encodeHex($item->id)) . '">
                                        Restore
                                    </a>
                                    <button class="dropdown-item text-danger kill-item" data-id="{{ $hash->encodeHex($item->id) }}" data-action="'. route('purchase.killItem', $hash->encodeHex($item->id)) .'">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('purchase', function (Item $item) {
                    return $item->purchase->title;
                })
                ->addColumn('price_per_item', function (Item $item) {
                    return 'Rp' . number_format($item->price_per_item,2,",",".");
                })
                ->addColumn('price_total_item', function (Item $item) {
                    return 'Rp' . number_format($item->price_total_item,2,",",".");
                })
                ->addColumn('deleted_at', function (Item $item) {
                    return $item->deleted_at->isoFormat('dddd, D MMMM Y, HH:mm:ss');
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make();
        }
    }

    public function trashPesan()
    {
        if(request()->ajax())
        {
            $queryPesan = Message::onlyTrashed()->with('sender', 'receiver');
            $hash = new Hashids('', 10);

            return DataTables::of($queryPesan)
                ->addColumn('action', function($item) use($hash) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('message.restore', $hash->encodeHex($item->id)) . '">
                                        Restore
                                    </a>
                                    <button class="dropdown-item text-danger kill-message" data-id="{{ $hash->encodeHex($item->id) }}" data-action="'. route('message.kill', $hash->encodeHex($item->id)) .'">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('sender', function (Message $message) {
                    return $message->sender->name;
                })
                ->addColumn('receiver', function (Message $message) {
                    return $message->receiver->name;
                })
                ->addColumn('deleted_at', function (Message $message) {
                    return $message->deleted_at->isoFormat('dddd, D MMMM Y, HH:mm:ss');
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make();
        }
    }
    
    public function trashPengguna()
    {
        if(request()->ajax())
        {
            $queryPengguna = User::onlyTrashed();
            $hash = new Hashids('', 10);

            return DataTables::of($queryPengguna)
                ->addColumn('action', function($item) use($hash) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('user.restore', $hash->encodeHex($item->id)) . '">
                                        Restore
                                    </a>
                                    <button class="dropdown-item text-danger kill-user" data-id="{{ $hash->encodeHex($item->id) }}" data-action="'. route('user.kill', $hash->encodeHex($item->id)) .'">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('deleted_at', function (User $user) {
                    return $user->deleted_at->isoFormat('dddd, D MMMM Y, HH:mm:ss');
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make();
        }
    }
}
