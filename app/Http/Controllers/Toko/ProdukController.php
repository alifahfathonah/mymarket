<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Toko;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
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
            $toko = Toko::where('user_id', $this->users->id)->first();
            $produk = Produk::with('kategori')->where('toko_id', $toko->id)->get();
            return Datatables::of($produk)
                ->addIndexColumn()
                ->editColumn('created_at', function($data){
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->addColumn('action', function ($row) {
//                    $btn = '<a href="'.route('admin.edittoko',$row->id).'" class="edit btn btn-success btn-sm m-1"> DETAIL</a>';
                    $btn2 = '<a href="#" class="hapus btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#modalHapus" data-id="'.$row->id.'"> HAPUS</a>';
                    return $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('toko.produk',array(
            'judul' => "Dashboard Toko | MYMARKET V.1.0",
            'aktifTag' => "produk",
            'tagSubMenu' => "produk",
        ));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('toko.formproduk',array(
            'judul' => "Dashboard Administrator | MYMARKET V.1.0",
            'aktifTag' => "produk",
            'tagSubMenu' => "produk",
            'tag' => 'add',
            'kategori' => $kategori,
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'kategori_id' => 'required|numeric',
            'name' => 'required|max:255',
            'satuan' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'harga' => 'required|numeric',

        ]);
        $file = $request->file('gambar');
        $gambarname = $file->hashName();
        $request->file('gambar')->store('produk', 'public');
        $toko = Toko::where('user_id', $this->users->id)->first();
        $produk = new Produk();
        $produk->kategori_id = $request->kategori_id;
        $produk->toko_id = $toko->id;
        $produk->name = $request->name;
        $produk->satuan = $request->satuan;
        $produk->gambar = $gambarname;
        $produk->harga = $request->harga;
        $produk->deskripsi = $request->deskripsi;
        $produk->save();
        notify()->preset('hapus', ['title' => 'Success', 'message' => 'Produk berhasil disimpan']);
        return redirect(route('toko.produk'));
    }

    public function destroy(Request $request)
    {
        $produk = Produk::find($request->id);
        $produk->delete();
        notify()->preset('hapus', ['title' => 'Success', 'message' => 'Data produk berhasil dihapus']);
        return redirect(route('toko.produk'));
    }
}
