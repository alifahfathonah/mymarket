<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Toko;
use App\Models\User;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TokoController extends Controller
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
            $toko = Toko::with('user')->get();
            return Datatables::of($toko)
                ->addIndexColumn()
                ->editColumn('created_at', function($data){
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('admin.edittoko',$row->id).'" class="edit btn btn-success btn-sm m-1"> EDIT</a>';
                    $btn2 = $btn.'<a href="#" class="hapus btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#modalHapus" data-id="'.$row->id.'"> HAPUS</a>';
                    return $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.toko',array(
            'judul' => "Dashboard Administrator | MYMARKET V.1.0",
            'aktifTag' => "toko",
            'tagSubMenu' => "toko",
        ));
    }

    public function create()
    {
        $user = User::whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                ->from('tokos')
                ->whereRaw('users.id = tokos.user_id');
        })
            ->where('role_id',2)
            ->get();
        return view('admin.formtoko',array(
            'judul' => "Dashboard Administrator | MYMARKET V.1.0",
            'aktifTag' => "toko",
            'tagSubMenu' => "toko",
            'tag' => 'add',
            'dataUser' => $user,
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'name' => 'required|max:255',
            'nohp' => 'required|max:255',
            'alamat' => 'required|max:255',
        ]);
        $toko = new Toko();
        $toko->name = $request->name;
        $toko->user_id = $request->user_id;
        $toko->nohp = $request->nohp;
        $toko->alamat = $request->alamat;
        $toko->ktp = $request->ktp;
        $toko->save();
        notify()->preset('hapus', ['title' => 'Success', 'message' => 'Toko berhasil disimpan']);
        return redirect(route('admin.toko'));
    }

    public function edit($id)
    {
        $toko = Toko::findOrFail($id);
        $user = User::whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                ->from('tokos')
                ->whereRaw('users.id = tokos.user_id');
        })
            ->where('role_id',2)
            ->get();
        return view('admin.formtoko',array(
            'judul' => "Dashboard Administrator | MYMARKET V.1.0",
            'aktifTag' => "toko",
            'tagSubMenu' => "toko",
            'tag' => 'edit',
            'id' => $id,
            'name' => $toko->name,
            'userid' => $toko->user_id,
            'nohp' => $toko->nohp,
            'alamat' => $toko->alamat,
            'ktp' => $toko->ktp,
            'dataUser' => $user,
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'idtoko' => 'required|numeric',
            'name' => 'required|max:255',
            'nohp' => 'required|max:255',
            'alamat' => 'required|max:255',
        ]);
        Toko::where('id',$request->idtoko)->update([
            'name' => $request->name,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'ktp' => $request->ktp,
        ]);
        notify()->preset('hapus', ['title' => 'Success', 'message' => 'Kategori berhasil diperbaharui']);
        return redirect(route('admin.edittoko',$request->idtoko));
    }

    public function destroy(Request $request)
    {
        $toko = Toko::find($request->id);
        $toko->delete();
        notify()->preset('hapus', ['title' => 'Success', 'message' => 'Data toko berhasil dihapus']);
        return redirect(route('admin.toko'));
    }
}
