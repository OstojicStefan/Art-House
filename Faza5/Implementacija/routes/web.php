<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\bogdan\GostController::class, 'login'])->name('login');
Route::get('/deposit_money', [App\Http\Controllers\nikola\KorisnikController::class, 'depositMoney'])->name('deposit_money');
Route::post('/deposit_money_submit', [\App\Http\Controllers\nikola\KorisnikController::class, 'depositMoneySubmit'])->name('deposit_money_submit');
Route::get('/auctions', [App\Http\Controllers\nikola\GostController::class, 'auctions'])->name('auctions');
Route::get('/founded_auctions', [App\Http\Controllers\nikola\GostController::class, 'foundedAuctions'])->name('founded_auctions');
Route::get('/auction/{id}', [App\Http\Controllers\nikola\KorisnikController::class, 'auction'])->name('auction');
Route::get('/exhibitions', [App\Http\Controllers\nikola\GostController::class, 'exhibitions'])->name('exhibitions');
Route::get('/founded_exhibitions', [App\Http\Controllers\nikola\GostController::class, 'foundedExhibitions'])->name('founded_exhibitions');
Route::get('/exhibition/{id}', [App\Http\Controllers\nikola\KorisnikController::class, 'exhibition'])->name('exhibition');
