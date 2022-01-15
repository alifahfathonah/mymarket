<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Detailtransaksi;
use App\Models\Produk;
use App\Models\Toko;
use App\Models\Transaksi;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
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

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $transaksi = Transaksi::where('user_id', $this->users->id)
                ->whereNotNull('kode')
                ->get();
            return Datatables::of($transaksi)
                ->addIndexColumn()
                ->editColumn('created_at', function($data){
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('user.detail',$row->id).'" class="edit btn btn-success btn-sm m-1"> DETAIL</a>';
//                    $btn2 = '<a href="#" class="hapus btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#modalHapus" data-id="'.$row->id.'"> HAPUS</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('user.transaksi',array(
            'judul' => "Dashboard Toko | MYMARKET V.1.0",
            'aktifTag' => "transaksi",
            'tagSubMenu' => "transaksi",
        ));
    }

    public function detail($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $detail = Detailtransaksi::where('transaksi_id',$id)->get();
        return view('user.detailtransaksi',array(
            'judul' => "Dashboard Toko | MYMARKET V.1.0",
            'aktifTag' => "transaksi",
            'tagSubMenu' => "transaksi",
            'detail' => $detail,
            'transaksi' => $transaksi,
        ));
    }
}
