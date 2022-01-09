<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController as DashAdmin,KategoriController as KatAdmin};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['web','auth','roles']],function() {
    Route::group(['roles' => 'admin'], function () {
        Route::get('/admin/dashboard', [DashAdmin::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/kategori', [KatAdmin::class, 'index'])->name('admin.kategori');
        Route::get('/admin/kategori/add', [KatAdmin::class, 'create'])->name('admin.addkategori');
        Route::get('/admin/kategori/{id}/edit', [KatAdmin::class, 'edit'])->name('admin.editkategori');
        Route::post('/admin/kategori', [KatAdmin::class, 'save'])->name('admin.savekategori');
        Route::patch('/admin/kategori', [KatAdmin::class, 'update'])->name('admin.updatekategori');
        Route::delete('/admin/kategori', [KatAdmin::class, 'destroy'])->name('admin.deletekategori');
    });

});

require __DIR__.'/auth.php';
