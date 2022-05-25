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

Route::get('/login',[App\Http\Controllers\bogdan\GostController::class,'login'] )->name('login');

Route::get('/myAccount/deleteAccount', [App\Http\Controllers\dimitrije\RegistredController::class, 'deleteAccount'])->name('deleteAccount');
Route::get('/myAccount/deleteAccountSubmit', [App\Http\Controllers\dimitrije\RegistredController::class, 'deleteAccountSubmit'])->name('deleteAccountSubmit');
Route::get('/adminDeleteAccount', [App\Http\Controllers\dimitrije\AdminController::class, 'adminDeleteAccount'])->name('adminDeleteAccount');
Route::post('/adminDeleteAccountSubmit', [App\Http\Controllers\dimitrije\AdminController::class, 'adminDeleteAccountSubmit'])->name('adminDeleteAccountSubmit');

Route::get('/banning', [App\Http\Controllers\dimitrije\ModeratorController::class, 'banning'])->name('banning');
Route::post('/banningSubmit', [App\Http\Controllers\dimitrije\ModeratorController::class, 'banningSubmit'])->name('banningSubmit');
Route::get('/unbanning', [App\Http\Controllers\dimitrije\ModeratorController::class, 'unbanning'])->name('unbanning');
Route::post('/unbanningSubmit', [App\Http\Controllers\dimitrije\ModeratorController::class, 'unbanningSubmit'])->name('unbanningSubmit');
Route::get('/downgradeModerator', [App\Http\Controllers\dimitrije\AdminController::class, 'downgradeModerator'])->name('downgradeModerator');
Route::post('/downgradeModeratorSubmit', [App\Http\Controllers\dimitrije\AdminController::class, 'downgradeModeratorSubmit'])->name('downgradeModeratorSubmit');


