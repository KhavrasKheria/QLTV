<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\SachController;
use App\Http\Controllers\VitriController;
use App\Http\Controllers\TacGiaController;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\NhaXuatBanController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MuonTraController;
use App\Http\Controllers\TheDocGiaController;
use App\Http\Controllers\MuonTraChiTietController;


Route::prefix('muon-tra')->middleware(['auth'])->group(function () {
    // Trang mượn sách
    Route::get('/', [MuonTraController::class, 'index'])->name('muontra.index');
    Route::post('/store', [MuonTraController::class, 'store'])->name('muontra.store');

    // Lịch sử mượn trả
    Route::get('/lich-su', [MuonTraController::class, 'lichsu'])->name('muontra.lichsu');

    // Chi tiết phiếu mượn
    Route::get('/chi-tiet/{MaMuon}', [MuonTraController::class, 'chiTiet'])->name('muontra.chi-tiet');

    // Trả sách
    Route::post('/tra/{MaMuon}', [MuonTraController::class, 'traPhieu'])->name('muontra.tra');

    // Gia hạn
    Route::post('/gia-han/{MaMuon}', [MuonTraController::class, 'giaHan'])->name('muontra.gia-han');

    // API: Lấy thông tin sách (cho AJAX)
    Route::get('/api/sach/{ISBN13}', [MuonTraChiTietController::class, 'thongTinSach'])->name('muontra.api.sach');
});
Route::get('/', function () {
    return view('trangchu.index');
});

Route::get('/danhsach', function () {
    return view('trangdanhsach.danhsach');
})->name('danhsach');

Route::get('/test1', function () {
    return view('test1');
});

Auth::routes();

Route::get('/admin', function () {
    return redirect('/login');
});

Route::get('/home', function () {
    return redirect('/ad');
})->name('home');
Route::get('/sach/{id}', [SachController::class, 'show'])->name('sach.show');

Route::middleware('auth')->group(function () {

    Route::get('/ad', function () {
        return view('layouts.partials.dashboard');
    });

    Route::get('/sach', [SachController::class, 'index'])->name('sach.index');
    Route::get('/sach/create', [SachController::class, 'create'])->name('sach.create');
    Route::post('/sach', [SachController::class, 'store'])->name('sach.store');
    Route::get('/sach/{id}/edit', [SachController::class, 'edit'])->name('sach.edit');
    Route::put('/sach/{id}', [SachController::class, 'update'])->name('sach.update');
    Route::delete('/sach/{id}', [SachController::class, 'destroy'])->name('sach.destroy');
    

    Route::get('/vitri', [VitriController::class, 'index'])->name('vitri.index');

    Route::resource('tacgia', TacGiaController::class);
    Route::resource('nhaxuatban', NhaXuatBanController::class);
    Route::post('/nhaxuatban/store', [NhaXuatBanController::class, 'store'])
        ->name('nhaxuatban.store');
    Route::resource('theloai', TheLoaiController::class)
        ->except(['create', 'edit', 'show']);

    Route::get('/search', [SearchController::class, 'index'])->name('search');

    Route::resource('thedocgia', TheDocGiaController::class);

    Route::get('muontra/lichsu', [MuonTraController::class, 'lichsu'])
        ->name('muontra.lichsu');

    Route::resource('muontra', MuonTraController::class)
        ->except(['show']);

    Route::post('/muontra/tra/{MaMuon}', [MuonTraController::class, 'update'])
        ->name('muontra.tra');
});
