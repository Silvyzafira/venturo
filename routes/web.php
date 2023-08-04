<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VenturoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/intermediate', function () {return view('welcome');});
Route::get('/intermediate/menu', [VenturoController::class, 'getMenuFromAPI']);
Route::get('/intermediate/tahun', [VenturoController::class, 'getTransaksiByTahun'])->name('getTransaksiByTahun');
Route::get('/intermediate', [VenturoController::class, 'getMenu']);
Route::get('/test', [VenturoController::class, 'index']);
Route::get('/fetch-data', [VenturoController::class, 'fetchData'])->name('fetch_data');


