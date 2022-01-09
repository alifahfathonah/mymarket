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
    });

});

require __DIR__.'/auth.php';
