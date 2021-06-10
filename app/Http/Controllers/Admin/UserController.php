<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.admin.user');
    }

    public function roleStaff()
    {
        if(request()->ajax())
        {
            $queryStaff = User::where('roles', 'Staff');
            $hash = new Hashids('', 10);

            return DataTables::of($queryStaff)
                ->addColumn('action', function($item) use($hash) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('user.change_role_user', $hash->encodeHex($item->id)) . '">
                                        Ubah Role Menjadi Visitor
                                    </a>
                                    <button class="dropdown-item text-danger remove-staff" data-id="{{ $hash->encodeHex($item->id) }}" data-action="'. route('user.destroy', $hash->encodeHex($item->id)) .'">
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
    }
    
    public function roleUser()
    {
        if(request()->ajax())
        {
            $queryUser = User::where('roles', 'User');
            $hash = new Hashids('', 10);

            return DataTables::of($queryUser)
                ->addColumn('action', function($item) use($hash) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('user.change_role_staff', $hash->encodeHex($item->id)) . '">
                                        Ubah Role Menjadi Staff
                                    </a>
                                    <button class="dropdown-item text-danger remove-user" data-id="{{ $hash->encodeHex($item->id) }}" data-action="'. route('user.destroy', $hash->encodeHex($item->id)) .'">
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
    }

    public function change_role_staff($id)
    {
        $item = [
            'roles' => 'Staff',
            'staff_status' => 1,
        ];

        $hash = new Hashids('', 10);

        User::whereId($hash->decodeHex($id))->update($item);

        return redirect()->route('user.index')->with('success', 'Role Pengguna Berhasil Diubah!');
    }

    public function change_role_user($id)
    {
        $item = [
            'roles' => 'User',
            'staff_status' => 0,
        ];

        $hash = new Hashids('', 10);

        User::whereId($hash->decodeHex($id))->update($item);

        return redirect()->route('user.index')->with('success', 'Role Pengguna Berhasil Diubah!');
    }

    public function destroy($id)
    {
        $hash = new Hashids('', 10);

        $item = User::findOrFail($hash->decodeHex($id));

        $item->delete();

        return redirect()->route('user.index')->with('success', 'Pengguna Berhasil Dihapus!');
    }

    public function restore($id)
    {
        $hash = new Hashids('', 10);

        $item = User::withTrashed()->where('id', $hash->decodeHex($id))->first();

        $item->restore();

        return redirect()->route('admin-trash')->with('success', 'Pengguna Berhasil Direstore!');
    }

    public function kill($id)
    {
        $hash = new Hashids('', 10);

        $item = User::withTrashed()->where('id', $hash->decodeHex($id))->first();

        $item->forceDelete();

        return redirect()->route('admin-trash')->with('success', 'Pengguna Berhasil Dihapus Permanen!');
    }
}
