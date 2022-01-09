<x-backend.dashboard-layout :title="$judul" :tagSubMenu="$tagSubMenu" :total-notif="null">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">kategori</li>
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
                            <h3 class="card-title">FORM INPUT {{($tag != 'edit')?"TAMBAH":"EDIT"}} KATEGORI</h3>
                            <a href="{{route('admin.kategori')}}">
                                <button class="btn btn-danger btn-sm float-right">KEMBALI</button>
                            </a>
                        </div>
                        <div class="card-body">
                            @if($tag != 'edit')
                                <form action="{{route('admin.savekategori')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama Kategori</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name">
                                        @error('name')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            @else
                                <form action="{{route('admin.updatekategori')}}" method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="form-group">
                                        <label for="name">Nama Kategori</label>
                                        <input type="text" name="id" value="{{$id}}">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{$name}}">
                                        @error('name')
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
