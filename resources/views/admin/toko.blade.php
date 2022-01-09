<x-backend.dashboard-layout :title="$judul" :tagSubMenu="$tagSubMenu" :total-notif="null">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>TOKO</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Toko</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <x:notify-messages/>
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Toko</h3>
                    <a href="{{route('admin.addtoko')}}"><button class="btn btn-primary btn-sm float-right">TAMBAH</button></a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0 display nowrap" id="tabeltoko"
                           style="width: 100%">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">NAMA TOKO</th>
                            <th scope="col" class="text-center">USER</th>
                            <th scope="col" class="text-center">ALAMAT</th>
                            <th scope="col" class="text-center">LOGO</th>
                            <th scope="col" class="text-center">KTP</th>
                            <th scope="col" class="text-center">DIBUAT</th>
                            <th scope="col" class="text-center">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
            <!-- START: MODAL HAPUS -->
            <div class="modal fade" id="modalHapus" tabindex="-1"  aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{route('admin.deletetoko')}}" method="post">
                        @csrf
                        @method('delete')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">HAPUS</h5>
                        </div>
                        <div class="modal-body">
                                <input type="hidden" id="idhapus" name="id" value="">
                            Apakah anda ingin menghapus data ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- END: MODAL HAPUS -->
        </section>
        <!-- /.content -->
    </div>
    <!-- START: Script -->
    <x-backend.script-layout />
    <!-- END: Script -->
    <script>
        $('#tabeltoko').DataTable({
            responsive : true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.toko') }}",
            columns: [
                {
                    data: 'index',
                    class: 'text-center',
                    defaultContent: '',
                    orderable: false,
                    searchable: false,
                    width: '5%',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1; //auto increment
                    }
                },
                {data: 'name', class: 'text-left'},
                {data: 'user.name', class: 'text-center'},
                {data: 'alamat', class: 'text-left'},
                {data: 'logo', class: 'text-left'},
                {data: 'ktp', class: 'text-left'},
                {data: 'created_at', class: 'text-center'},
                {data: 'action', width: '15%',class: 'text-center'},
            ],

        });
        $(document).on("click", ".hapus", function () {
            var id = $(this).data('id');
            $('#idhapus').val(id);

        });
    </script>

</x-backend.dashboard-layout>
