<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;

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

Route::middleware(['guest'])->group(function () {
    // register
    Route::get("/register", [AuthController::class,'register'] );
    Route::post('/store/register', [AuthController::class,'storeregister'] );
    //login
    Route::get("/login", [AuthController::class,'login'] )->name('login');
    Route::post('/store/login', [AuthController::class,'storelogin'] );

});






Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth'])->group(function(){
Route::get('/barang.index', [BarangController::class,'index']);
Route::get('createbarang', [BarangController::class,'create']);
Route::post('/barang.store', [BarangController::class,'store']);

Route::get('/transaksi.index', [TransaksiController::class,'index']);
Route::get('createtransaksi',[TransaksiController::class,'create']);
Route::post('/transaksi.store', [TransaksiController::class,'store']);
});
