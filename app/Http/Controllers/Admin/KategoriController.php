<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Rpo;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
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
            $kategori = Kategori::all();
            return Datatables::of($kategori)
                ->addIndexColumn()
                ->editColumn('created_at', function($data){
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('admin.editkategori',$row->id).'" class="edit btn btn-success btn-sm m-1"> EDIT</a>';
                    $btn2 = $btn.'<a href="#" class="hapus btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#modalHapus" data-id="'.$row->id.'"> HAPUS</a>';
                    return $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.kategori',array(
            'judul' => "Dashboard Administrator | MYMARKET V.1.0",
            'aktifTag' => "kategori",
            'tagSubMenu' => "kategori",
        ));
    }

    public function create()
    {
        return view('admin.formkategori',array(
            'judul' => "Dashboard Administrator | MYMARKET V.1.0",
            'aktifTag' => "kategori",
            'tagSubMenu' => "kategori",
            'tag' => 'add',
        ));
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.formkategori',array(
            'judul' => "Dashboard Administrator | MYMARKET V.1.0",
            'aktifTag' => "kategori",
            'tagSubMenu' => "kategori",
            'tag' => 'edit',
            'id' => $id,
            'name' => $kategori->name,
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $kategori = new Kategori();
        $kategori->name = $request->name;
        $kategori->save();
        notify()->preset('hapus', ['title' => 'Success', 'message' => 'Kategori berhasil disimpan']);
        return redirect(route('admin.kategori'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|max:255',
        ]);
        Kategori::where('id',$request->id)->update([
            'name' => $request->name,
        ]);
        notify()->preset('hapus', ['title' => 'Success', 'message' => 'Kategori berhasil diperbaharui']);
        return redirect(route('admin.editkategori',$request->id));

    }

    public function destroy(Request $request)
    {
        $kategori = Kategori::find($request->id);
        $kategori->delete();
        notify()->preset('hapus', ['title' => 'Success', 'message' => 'Data kategori berhasil dihapus']);
        return redirect(route('admin.kategori'));
    }

}
