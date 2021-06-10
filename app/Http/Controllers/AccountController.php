<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\User;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $hash = new Hashids('', 10);

        return view('pages.account',[
            'user' => $user,
            'hash' => $hash,
        ]);
    }

    public function update(AccountRequest $request, $id)
    {
        if ($request->hasFile('avatar')) {
            $data = [
                'name' => $request->name,
                'avatar' => $request->avatar,
            ];
            $data['avatar'] = $request->file('avatar')->store('assets/avatar','public');
        } else if ($request->has('phone_number')) {
            $data = [
                'name' => $request->name,
                'phone_number' => $request->phone_number,
            ];
        } else if ($request->hasFile('avatar') && $request->input('phone_number')) {
            $data = $request->all();
            $data['avatar'] = $request->file('avatar')->store('assets/avatar','public');
        } else {
            $data = [
                'name' => $request->name,
            ];
        }

        $hash = new Hashids('', 10);
        $item = User::whereId($hash->decodeHex($id));
        $item->update($data);

        return redirect()->route('account.index')->with('success', 'Profil Berhasil Diedit!');
    }
}
