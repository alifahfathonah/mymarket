<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController as DashAdmin,KategoriController as KatAdmin,TokoController as TokAdmin};
use App\Http\Controllers\Toko\{DashboardController as DashToko,ProdukController as ProdukToko};
use App\Http\Controllers\User\{DashboardController as DashUser,BelanjaController as BelanjaUser,KeranjangController as KeranjangUser,TransaksiController as TransUser};


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['web','auth','roles']],function() {
    Route::group(['roles' => 'admin'], function () {
        Route::get('/admin/dashboard', [DashAdmin::class, 'index'])->name('admin.dashboard');

        Route::get('/admin/toko', [TokAdmin::class, 'index'])->name('admin.toko');
        Route::get('/admin/toko/add', [TokAdmin::class, 'create'])->name('admin.addtoko');
        Route::post('/admin/toko', [TokAdmin::class, 'save'])->name('admin.savetoko');
        Route::patch('/admin/toko', [TokAdmin::class, 'update'])->name('admin.updatetoko');
        Route::delete('/admin/toko', [TokAdmin::class, 'destroy'])->name('admin.deletetoko');
        Route::get('/admin/toko/{id}/edit', [TokAdmin::class, 'edit'])->name('admin.edittoko');

        Route::get('/admin/kategori', [KatAdmin::class, 'index'])->name('admin.kategori');
        Route::get('/admin/kategori/add', [KatAdmin::class, 'create'])->name('admin.addkategori');
        Route::get('/admin/kategori/{id}/edit', [KatAdmin::class, 'edit'])->name('admin.editkategori');
        Route::post('/admin/kategori', [KatAdmin::class, 'save'])->name('admin.savekategori');
        Route::patch('/admin/kategori', [KatAdmin::class, 'update'])->name('admin.updatekategori');
        Route::delete('/admin/kategori', [KatAdmin::class, 'destroy'])->name('admin.deletekategori');
    });

    Route::group(['roles' => 'toko'], function () {
        Route::get('/store/dashboard', [DashToko::class, 'index'])->name('toko.dashboard');
        Route::get('/store/produk', [ProdukToko::class, 'index'])->name('toko.produk');
        Route::post('/store/produk', [ProdukToko::class, 'save'])->name('toko.saveproduk');
        Route::delete('/store/produk', [ProdukToko::class, 'destroy'])->name('toko.deleteproduk');
        Route::get('/store/produk/add', [ProdukToko::class, 'create'])->name('toko.addproduk');
    });
    Route::group(['roles' => 'user'], function () {
        Route::get('/user/dashboard', [DashUser::class, 'index'])->name('user.dashboard');
        Route::get('/user/belanja/{id?}', [BelanjaUser::class, 'index'])->name('user.belanja');
        Route::post('/user/belanja', [BelanjaUser::class, 'save'])->name('user.savebelanja');
        Route::get('/user/keranjang', [KeranjangUser::class, 'index'])->name('user.keranjang');
        Route::post('/user/keranjang', [KeranjangUser::class, 'save'])->name('user.savekeranjang');
        Route::get('/user/transaksi', [TransUser::class, 'index'])->name('user.transaksi');

    });

});

require __DIR__.'/auth.php';
