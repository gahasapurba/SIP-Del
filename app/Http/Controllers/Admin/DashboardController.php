<?php

namespace App\Http\Controllers\Admin;

use App\Announcement;
use App\Http\Controllers\Controller;
use App\Message;
use App\Purchase;
use App\User;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();

        $paid = Purchase::where('purchasing_status', 'sudah')->count();
        $unpaid = Purchase::where('purchasing_status', 'belum')->count();
        $purchase = Purchase::latest()->take(2)->get();

        $announcement = Announcement::latest()->take(2)->get();

        $message = Message::with('sender')->where('receiver_users_id', Auth::user()->id)->latest()->take(2)->get();

        $hash = new Hashids('', 10);

        return view('pages.admin.dashboard',[
            'user' => $user,

            'paid' => $paid,
            'unpaid' => $unpaid,
            'purchases' => $purchase,

            'announcements' => $announcement,

            'messages' => $message,

            'hash' => $hash,
        ]);
    }
}
