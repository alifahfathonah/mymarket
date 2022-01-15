<x-backend.dashboard-layout :title="$judul" :tagSubMenu="$tagSubMenu" :total-notif="null">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">INVOICE NOMOR:  #{{strtoupper($transaksi->kode)}}</h3>


                </div>
                <div class="card-body">
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $no=1;$grandtotal = 0 @endphp
                                @foreach($detail as $row)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$row->produk->name}}</td>
                                        <td>{{$row->jumlah}}</td>
                                        <td>{{ number_format($row->jumlah * $row->produk->harga,0,".",".") }}</td>
                                    </tr>
                                    @php $grandtotal = $grandtotal + $row->jumlah * $row->produk->harga @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">
                            <p class="lead">Payment Methods:</p>


                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                VIa Bank ke rekening: 1234567<br>
                                an: Apri
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Total:</th>
                                        <td>Rp. {{number_format($grandtotal,0,".",".")}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{route('user.transaksi')}}"><button class="btn btn-sm btn-danger">Back</button></a>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- START: Script -->
    <x-backend.script-layout />
    <!-- END: Script -->
</x-backend.dashboard-layout>
