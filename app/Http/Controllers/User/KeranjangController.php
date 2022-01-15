<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Detailtransaksi;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
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
    public function index($id=null)
    {
        $transaksi = Transaksi::where('user_id',$this->users->id)
            ->whereNull('kode')
            ->first();
        if($transaksi !=null){
            $detail = Detailtransaksi::with('produk')->where('transaksi_id',$transaksi->id)->get();
            $hitung = $detail->count();
            $idTransaksi = $transaksi->id;
        } else{
            $detail = [];
            $hitung = 0;
            $idTransaksi = null;
        }
        return view('user.keranjang',array(
            'judul' => "Dashboard Toko | MYMARKET V.1.0",
            'aktifTag' => "belanja",
            'tagSubMenu' => "belanja",
            'totalNotif' => $hitung,
            'detail' => $detail,
            'idTransaksi' =>  $idTransaksi,
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'grandtotal' => 'required|numeric',
            'idkeranjang' => 'required|numeric',
        ]);
        Transaksi::where('id',$request->idkeranjang)->update([
           'kode' =>  $this->generateRandomString(),
            'total' => $request->grandtotal,
        ]);
        notify()->preset('hapus', ['title' => 'Success', 'message' => 'Anda berhasil Checkout']);
        return redirect(route('user.belanja'));
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
