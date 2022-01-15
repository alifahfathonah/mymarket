<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Detailtransaksi;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BelanjaController extends Controller
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
        if($id != null){
            $produk = Produk::where('kategori_id',$id)->get();
        } else {
            $produk = Produk::all();
        }
        $transaksi = Transaksi::where('user_id',$this->users->id)
            ->whereNull('kode')
            ->first();
        if($transaksi !=null){
            $detail = Detailtransaksi::where('transaksi_id',$transaksi->id)->get()->count();
        } else{
            $detail = 0;
        }
        $kategori = Kategori::all();
        return view('user.belanja',array(
            'judul' => "Dashboard Toko | MYMARKET V.1.0",
            'aktifTag' => "belanja",
            'tagSubMenu' => "belanja",
            'kategori' => $kategori,
            'produk' => $produk,
            'totalNotif' => $detail,
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'idproduk' => 'required|numeric',
        ]);
        $idUser = $this->users->id;
        $transaksi = Transaksi::where('user_id',$idUser)
            ->whereNull('kode')
            ->first();

        if($transaksi != null){
            $idTransaksi = $transaksi->id;
            $produk = Detailtransaksi::where('transaksi_id',$idTransaksi)
                ->where('produk_id',$request->idproduk)
                ->first();
            if($produk != null){
                Detailtransaksi::where('id',$produk->id)->update([
                    'jumlah' => $produk->jumlah + 1,
                ]);
                notify()->preset('hapus', ['title' => 'Success', 'message' => 'Jumlah Produk berhasil diperbaharui ke dalam keranjang']);
            } else {
                $detail = new Detailtransaksi();
                $detail->transaksi_id = $idTransaksi;
                $detail->produk_id = $request->idproduk;
                $detail->jumlah = 1;
                notify()->preset('hapus', ['title' => 'Success', 'message' => 'Produk berhasil ditambahkan ke dalam keranjang']);
                $detail->save();
            }
            return redirect(route('user.belanja'));
        } else {
            $produk = Produk::findOrFail($request->idproduk);
            $transaksi = new Transaksi();
            $transaksi->user_id = $idUser;
            $transaksi->total = $produk->harga;
            $transaksi->status = 1;
            $transaksi->save();
            $idTransaksi = $transaksi->id;

            $detail = new Detailtransaksi();
            $detail->transaksi_id = $idTransaksi;
            $detail->produk_id = $request->idproduk;
            $detail->jumlah = 1;
            $detail->save();
            notify()->preset('hapus', ['title' => 'Success', 'message' => 'Produk berhasil ditambahkan ke dalam keranjang']);
            return redirect(route('user.belanja'));

        }
    }
}
