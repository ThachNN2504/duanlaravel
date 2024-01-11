<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoaiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Facade\DB;

Route::get('/', [SanPhamController::class, 'index']);
Route::get('/sp/{id}', [SanPhamController::class, 'chitiet']);
Route::get('/cuahang', [SanPhamController::class, 'cuahang']);
Route::get('/loai/{id}', [SanPhamController::class, 'sptrongloai']);
Route::get('/timkiem', [SanPhamController::class, 'timkiem'])->name('products_search');

Route::post('themgiohang', [SanPhamController::class, 'themgiohang']);
Route::get('/hiengiohang', [SanPhamController::class, 'hiengiohang']);
Route::get('/xoasptronggio/{idsp}', [SanPhamController::class, 'xoasptronggio']);
Route::get('/xoagiohang', [SanPhamController::class, 'xoagiohang']);

Route::get('/luudon', [SanPhamController::class, 'hienform']);
Route::post('/thanhtoan', [SanPhamController::class, 'thanhtoan']);

Route::get('/thongbao', [SanPhamController::class, 'thongbao']);

Route::get('/chenuser', [UserController::class, 'chenuser']);


use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSPController;

Route::group(['prefix' => 'admin'], function () {

    Route::get('dangnhap', [AdminController::class, 'dangnhap']);
    Route::post('dangnhap', [AdminController::class, 'dangnhap_']);
    Route::get('thoat', [AdminController::class, 'thoat']);
});
Route::group(['prefix' => 'admin', 'middleware' => 'adminauth'], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::resource('/loai', AdminLoaiController::class);
    Route::resource('/sanpham', AdminSPController::class);
});


Route::get('/dangnhap', [App\Http\Controllers\ThanhvienController::class, 'dangnhap'])->name('login');
Route::post('/dangnhap', [App\Http\Controllers\ThanhvienController::class, 'dangnhap_']);
Route::get('/thoat', [App\Http\Controllers\ThanhvienController::class, 'thoat']);
Route::get('/download', [SanPhamController::class, 'download'])->middleware('auth');
Route::get('/dangky', [App\Http\Controllers\ThanhvienController::class, 'dangky']);
Route::post('/dangky', [App\Http\Controllers\ThanhvienController::class, 'dangky_']);
Route::get('/camon', [App\Http\Controllers\ThanhvienController::class, 'camon']);

use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/download', [SanPhamController::class, 'download'])->middleware('auth', 'verified');

// use App\Mail\GuiEmail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

Route::get('/email/verify', function () {
    return view('verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Thư kích hoạt đã gửi!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post("/guilienhe", function (Illuminate\Http\Request $request) {

    Session::flash('thongbao', "Đã gửi mail");
    return redirect("thongbao");
});
