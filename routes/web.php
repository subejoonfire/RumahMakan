<?php

use App\Events\testing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// Ajax routes
Route::get('layouts.table', function () {
    return view('layouts.table');
});

//Controller routes
Route::get('login', [Controller::class, 'login']);
Route::get('barangKeluar', [Controller::class, 'barangKeluar'])->name('barangKeluar');
Route::get('barangMasuk', [Controller::class, 'barangMasuk'])->name('barangMasuk');
Route::get('tambahBarang', [Controller::class, 'tambahBarang'])->name('tambahBarang');
Route::get('hapusBarang', [Controller::class, 'hapusBarang'])->name('hapusBarang');
Route::get('editBarangAction', [Controller::class, 'editBarangAction'])->name('editBarangAction');
Route::get('hapusRiwayat', [Controller::class, 'hapusRiwayat'])->name('hapusRiwayat');

// Login/Logout
Route::get('logout', function () {
    Auth::logout();
    return redirect('/')->with('welcome', 'Berhasil logout');
});
//Pages routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', function () {
        return view('pages.dashboard');
    });

    Route::get('cekbarang', function () {
        return view('pages.cekbarang');
    });

    Route::get('barangmasuk', function () {
        return view('pages.barangmasuk');
    });

    Route::get('barangkeluar', function () {
        return view('pages.barangkeluar');
    });

    Route::get('barang', function () {
        return view('pages.barang');
    });

    Route::get('riwayat', function () {
        return view('pages.riwayat');
    });

    Route::get('editBarang', function () {
        return view('pages.editbarang');
    });
});
