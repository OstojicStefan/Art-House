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
Route::post('/loginSubmit',[App\Http\Controllers\bogdan\GostController::class,'loginSubmit'] )->name('loginSubmit');
Route::get('/register',[App\Http\Controllers\bogdan\GostController::class,'register'] )->name('register');
Route::post('/registerSubmit',[App\Http\Controllers\bogdan\GostController::class,'registerSubmit'] )->name('registerSubmit');
Route::get('/addTags',[App\Http\Controllers\bogdan\RegistrovaniKontroler::class,'addTags'] )->name('addTags');
Route::get('/removeTags',[App\Http\Controllers\bogdan\RegistrovaniKontroler::class,'removeTags'] )->name('removeTags');
Route::get('/createAuctionVirtual',[App\Http\Controllers\bogdan\RegistrovaniKontroler::class,'createAuctionVirtual'] )->name('createAuctionVirtual');
Route::get('/createAuctionPhysical',[App\Http\Controllers\bogdan\RegistrovaniKontroler::class,'createAuctionPhysical'] )->name('createAuctionPhysical');
Route::post('/removeTags2',[App\Http\Controllers\bogdan\RegistrovaniKontroler::class,'removeTags2'] )->name('removeTags2');
Route::post('/addTagsSubmit',[App\Http\Controllers\bogdan\RegistrovaniKontroler::class,'addTagsSubmit'] )->name('addTagsSubmit');
Route::get('/upgradeUserRoles',[App\Http\Controllers\bogdan\RegistrovaniKontroler::class,'upgradeUserRoles'] )->name('upgradeUserRoles');
Route::post('/upgradeUserRolesSubmit',[App\Http\Controllers\bogdan\RegistrovaniKontroler::class,'upgradeUserRolesSubmit'] )->name('upgradeUserRolesSubmit');