<x-backend.dashboard-layout :title="$judul" :tagSubMenu="$tagSubMenu" :total-notif="null">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>PRODUK</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">PRODUK</li>
                            <li class="breadcrumb-item active">{{($tag != 'edit')?"tambah":"edit"}} </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <x:notify-messages/>
            <div class="row">
                <div class="col-md-8">

                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">FORM INPUT {{($tag != 'edit')?"TAMBAH":"EDIT"}} TOKO</h3>
                            <a href="{{route('toko.produk')}}">
                                <button class="btn btn-danger btn-sm float-right">KEMBALI</button>
                            </a>
                        </div>
                        <div class="card-body">
                            @if($tag != 'edit')
                                <form action="{{route('toko.saveproduk')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="kategori_id">Kategori</label>
                                        <select name="kategori_id" class="form-control" id="user_id">
                                            <option value="">Pilih</option>
                                            @foreach($kategori as $row)
                                                <option value="{{$row->id}}" {{(old('kategori_id') == $row->id)?"SELECTED":""}}>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Nama Produk</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{old('name')}}">
                                        @error('name')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="satuan">Satuan</label>
                                        <select name="satuan" class="form-control" id="satuan">
                                            <option value="">Pilih</option>
                                            <option value="PCS">PCS</option>
                                            <option value="UNIT">UNIT</option>
                                        </select>
                                        @error('satuan')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                               id="harga" name="harga" value="{{old('harga')}}">
                                        @error('harga')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                               id="deskripsi" name="deskripsi" value="{{old('deskripsi')}}">
                                        @error('deskripsi')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="gambar" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        @error('gambar')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            @else
                                <form action="{{route('admin.updatetoko')}}" method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="form-group">
                                        <input type="hidden" name="idtoko" value="{{$id}}">
                                        <label for="name">Nama TOKO</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{$name}}">
                                        @error('name')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nohp">No HP</label>
                                        <input type="text" class="form-control @error('nohp') is-invalid @enderror"
                                               id="nohp" name="nohp" value="{{$nohp}}">
                                        @error('nohp')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                               id="alamat" name="alamat" value="{{$alamat}}">
                                        @error('alamat')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="ktp">Ktp</label>
                                        <input type="text" class="form-control @error('ktp') is-invalid @enderror"
                                               id="ktp" name="ktp" value="{{$ktp}}">
                                        @error('ktp')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>


        </section>
        <!-- /.content -->



    </div>
    <!-- START: Script -->
    <x-backend.script-layout/>
    <!-- END: Script -->


</x-backend.dashboard-layout>
