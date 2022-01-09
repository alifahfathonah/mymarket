<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Toko;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $users;
    protected $role;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users=Auth::user();
            $this->role=User::with('role')->find($this->users->id)->role;
            return $next($request);
        });
    }

    public function index()
    {

        return view('admin.dashboard',array(
            'judul' => "Dashboard Toko | MYMARKET V.1.0",
            'aktifTag' => "dashboard",
            'tagSubMenu' => "dashboard",
        ));
    }
}
