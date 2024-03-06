<?php

use App\Http\Controllers\KRSController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\TOEICController;
use Illuminate\Support\Facades\Route;

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

Route::get('/nilai', [NilaiController::class, 'index']);
Route::get('/krs', [KRSController::class, 'index']);
Route::get('/toeic', [TOEICController::class, 'index']);
Route::get('/', function () {
    return view('home');
});
Route::get('/get-fakultas-table/{fakultas}', [NilaiController::class, 'getFakultasTable']);
Route::get('/get-EIC-table/{EIC}', [TOEICController::class, 'getEICTable']);
