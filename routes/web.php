<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SachController;
use App\Http\Controllers\VitriController;
use App\Http\Controllers\TacGiaController;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\NhaXuatBanController;
// Menu danh mục sách
Route::middleware('auth')->group(function () {
    Route::get('/sach', [SachController::class, 'index'])->name('sach.index');
    Route::get('/sach/create', [SachController::class, 'create'])->name('sach.create');
    Route::post('/sach', [SachController::class, 'store'])->name('sach.store');
    Route::get('/sach/{id}/edit', [SachController::class, 'edit'])->name('sach.edit');
    Route::put('/sach/{id}', [SachController::class, 'update'])->name('sach.update');
    Route::delete('/sach/{id}', [SachController::class, 'destroy'])->name('sach.destroy');
});
Route::get('/index', function () {
    return view('trangchu.index');
});
Route::get('/test1', function () {
    return view('test1');
});
// Khi vào "/" thì chuyển đến trang đăng nhập
Route::get('/', function () {
    return redirect('/login');
});

// Trang admin (chỉ vào được sau khi đăng nhập)
Route::get('/ad', function () {
    return view('layouts.admin');
})->middleware('auth');

Route::get('/ad', function () {
    return view('layouts.partials.dashboard'); // dashboard mặc định
})->middleware('auth');


// Route mặc định của Laravel Auth
Auth::routes();

// Sau khi đăng nhập → vào trang admin
Route::get('/home', function () {
    return redirect('/ad');
})->name('home');
Route::get('/danhsach', function () {
    return view('trangdanhsach.danhsach');
})->name('danhsach');
// Route hiển thị chi tiết sách
Route::get('/sach/{id}', [SachController::class, 'show'])->name('sach.show');
Route::get('/vitri', [VitriController::class, 'index'])->name('vitri.index');
Route::resource('tacgia', TacGiaController::class);
Route::resource('nhaxuatban', NhaXuatBanController::class);
Route::resource('theloai', TheLoaiController::class)
    ->except(['create', 'edit', 'show']);

