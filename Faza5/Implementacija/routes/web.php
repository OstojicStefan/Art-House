<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\stefan\CreateExhibitionController;
use App\Http\Controllers\bogdan\GostController as GostControllerBogdan;
use App\Http\Controllers\bogdan\RegistrovaniKontroler as RegistrovaniKontrolerBogdan;

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

Route::get('/deposit_money', [App\Http\Controllers\nikola\KorisnikController::class, 'depositMoney'])->name('deposit_money');
Route::post('/deposit_money_submit', [\App\Http\Controllers\nikola\KorisnikController::class, 'depositMoneySubmit'])->name('deposit_money_submit');
Route::get('/auctions', [App\Http\Controllers\nikola\GostController::class, 'auctions'])->name('auctions');
Route::get('/founded_auctions', [App\Http\Controllers\nikola\GostController::class, 'foundedAuctions'])->name('founded_auctions');
Route::get('/auction/{id}', [App\Http\Controllers\nikola\KorisnikController::class, 'auction'])->name('auction');
Route::get('/exhibitions', [App\Http\Controllers\nikola\GostController::class, 'exhibitions'])->name('exhibitions');
Route::get('/founded_exhibitions', [App\Http\Controllers\nikola\GostController::class, 'foundedExhibitions'])->name('founded_exhibitions');
Route::get('/exhibition/{id}', [App\Http\Controllers\nikola\KorisnikController::class, 'exhibition'])->name('exhibition');

Route::get('/login',[GostControllerBogdan::class,'login'] )->name('login');
Route::post('/loginSubmit',[GostControllerBogdan::class,'loginSubmit'] )->name('loginSubmit');
Route::get('/register',[GostControllerBogdan::class,'register'] )->name('register');
Route::post('/registerSubmit',[bogdan\GostControllerBogdan::class,'registerSubmit'] )->name('registerSubmit');
Route::get('/addTags',[RegistrovaniKontrolerBogdan::class,'addTags'] )->name('addTags');
Route::get('/removeTags',[RegistrovaniKontrolerBogdan::class,'removeTags'] )->name('removeTags');
Route::get('/createAuctionVirtual',[RegistrovaniKontrolerBogdan::class,'createAuctionVirtual'] )->name('createAuctionVirtual');
Route::post('/createAuctionSubmit',[RegistrovaniKontrolerBogdan::class,'createAuctionSubmit'] )->name('createAuctionSubmit');
Route::get('/createAuctionPhysical',[RegistrovaniKontrolerBogdan::class,'createAuctionPhysical'] )->name('createAuctionPhysical');
Route::post('/removeTags2',[RegistrovaniKontrolerBogdan::class,'removeTags2'] )->name('removeTags2');
Route::post('/addTagsSubmit',[RegistrovaniKontrolerBogdan::class,'addTagsSubmit'] )->name('addTagsSubmit');
Route::get('/upgradeUserRoles',[RegistrovaniKontrolerBogdan::class,'upgradeUserRoles'] )->name('upgradeUserRoles');
Route::post('/upgradeUserRolesSubmit',[RegistrovaniKontrolerBogdan::class,'upgradeUserRolesSubmit'] )->name('upgradeUserRolesSubmit');
Route::get('/logout',[RegistrovaniKontrolerBogdan::class,'logout'] )->name('logout');
Route::get('/test2',[GostControllerBogdan::class,'test2'] )->name('test2');
Route::get('/test3',[GostControllerBogdan::class,'test3'] )->name('test3');
Route::get('/test4',[GostControllerBogdan::class,'test4'] )->name('test4');

Route::get('/createExhibition', [CreateExhibitionController::class,'createExhibition'])->name('createExhibition');
Route::get('/myExhibition', [CreateExhibitionController::class,'myExhibition']);
Route::post('/createExhibitionSubmit', [CreateExhibitionController::class, 'createExhibitionSubmit'])->name('createExhibitionSubmit');


