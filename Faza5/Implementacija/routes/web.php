<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\stefan\CreateExhibitionController;
use App\Http\Controllers\bogdan\GostController as GostControllerBogdan;
use App\Http\Controllers\bogdan\RegistrovaniKontroler as RegistrovaniKontrolerBogdan;
use App\Http\Controllers\bogdan\AdministratorController as AdministratorKontrolerBogdan;
use App\Http\Controllers\bogdan\ModeratorController as ModeratorControllerBogdan;
use App\Http\Controllers\nikola\GostController as GostControllerNikola;
use App\Http\Controllers\nikola\KorisnikController as KorisnikControllerNikola;
use App\Http\Controllers\nikola\MailController as MailControllerNikola;

use App\Http\Controllers\stefan\AccountController;
use App\Http\Controllers\stefan\ChatController;

use App\Http\Controllers\dimitrije\RegistredController as RegistredControllerDimitrije;
use App\Http\Controllers\dimitrije\ModeratorController as ModeratorControllerDimitrije;
use App\Http\Controllers\dimitrije\AdminController as AdminControllerDimitrije;


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

/*Route::get('/', function () {
    return view('stefan/index', ['body_id' => 'index_body'], [AccountController::class, 'indexInit']);
});*/

Route::get('/', [AccountController::class, 'indexInit'])->name('indexInit');

Route::get('/deposit_money', [KorisnikControllerNikola::class, 'depositMoney'])->name('deposit_money');
Route::get('/deposit_money_submit', [KorisnikControllerNikola::class, 'depositMoneySubmit'])->name('deposit_money_submit');
Route::get('/auctions', [GostControllerNikola::class, 'auctions'])->name('auctions');
Route::get('/found_auctions', [GostControllerNikola::class, 'foundAuctions'])->name('found_auctions');
Route::get('/auction/{id}', [KorisnikControllerNikola::class, 'auction'])->name('auction');
Route::get('/exhibitions', [GostControllerNikola::class, 'exhibitions'])->name('exhibitions');
Route::get('/found_exhibitions', [GostControllerNikola::class, 'foundExhibitions'])->name('found_exhibitions');
Route::get('/exhibition/{id}', [KorisnikControllerNikola::class, 'exhibition'])->name('exhibition');
Route::get('/send_test_mail', [MailControllerNikola::class, 'sendTestMail'])->name('send_test_mail');
Route::get('/rate_exhibition', [KorisnikControllerNikola::class, 'rateExhibition'])->name('rate_exhibition');


Route::get('/login', [GostControllerBogdan::class, 'login'])->name('login');
Route::post('/loginSubmit', [GostControllerBogdan::class, 'loginSubmit'])->name('loginSubmit');
Route::get('/register', [GostControllerBogdan::class, 'register'])->name('register');
Route::post('/registerSubmit', [GostControllerBogdan::class, 'registerSubmit'])->name('registerSubmit');
Route::get('/addTags', [ModeratorControllerBogdan::class, 'addTags'])->name('addTags');
Route::get('/removeTags', [ModeratorControllerBogdan::class, 'removeTags'])->name('removeTags');
Route::get('/createAuctionVirtual', [RegistrovaniKontrolerBogdan::class, 'createAuctionVirtual'])->name('createAuctionVirtual');
Route::post('/createAuctionSubmit', [RegistrovaniKontrolerBogdan::class, 'createAuctionSubmit'])->name('createAuctionSubmit');
Route::get('/createAuctionPhysical', [RegistrovaniKontrolerBogdan::class, 'createAuctionPhysical'])->name('createAuctionPhysical');
Route::post('/removeTags2', [ModeratorControllerBogdan::class, 'removeTags2'])->name('removeTags2');
Route::post('/addTagsSubmit', [ModeratorControllerBogdan::class, 'addTagsSubmit'])->name('addTagsSubmit');
Route::get('/upgradeUserRoles', [AdministratorKontrolerBogdan::class, 'upgradeUserRoles'])->name('upgradeUserRoles');
Route::post('/upgradeUserRolesSubmit', [AdministratorKontrolerBogdan::class, 'upgradeUserRolesSubmit'])->name('upgradeUserRolesSubmit');
Route::get('/logout', [RegistrovaniKontrolerBogdan::class, 'logout'])->name('logout');
Route::get('/test2', [GostControllerBogdan::class, 'test2'])->name('test2');
Route::get('/test3', [GostControllerBogdan::class, 'test3'])->name('test3');
Route::get('/test4', [GostControllerBogdan::class, 'test4'])->name('test4');

Route::get('/createExhibition', [CreateExhibitionController::class, 'createExhibition'])->name('createExhibition');
Route::get('/myExhibition', [CreateExhibitionController::class, 'myExhibition']);
Route::post('/createExhibitionSubmit', [CreateExhibitionController::class, 'createExhibitionSubmit'])->name('createExhibitionSubmit');
Route::get('/myAccount', [AccountController::class, 'myAccount'])->name('myAccount');
Route::post('/sendMessageSubmit', [ChatController::class, 'sendMessageSubmit'])->name('sendMessageSubmit');
Route::get('myAccount/settings', [AccountController::class, 'myAccountSettings'])->name('settings');
Route::post('/settingsSubmit', [AccountController::class, 'settingsSubmit'])->name('settingsSubmit');
Route::get('/aboutUs', [AccountController::class, 'aboutUs'])->name('aboutUs');



Route::get('/myAccount/settings/deleteAccount', [RegistredControllerDimitrije::class, 'deleteAccount'])->name('deleteAccount');
Route::get('/myAccount/settings/deleteAccountSubmit', [RegistredControllerDimitrije::class, 'deleteAccountSubmit'])->name('deleteAccountSubmit');
Route::get('/adminDeleteAccount', [AdminControllerDimitrije::class, 'adminDeleteAccount'])->name('adminDeleteAccount');
Route::post('/adminDeleteAccountSubmit', [AdminControllerDimitrije::class, 'adminDeleteAccountSubmit'])->name('adminDeleteAccountSubmit');

Route::get('/banning', [ModeratorControllerDimitrije::class, 'banning'])->name('banning');
Route::post('/banningSubmit', [ModeratorControllerDimitrije::class, 'banningSubmit'])->name('banningSubmit');
Route::get('/unbanning', [ModeratorControllerDimitrije::class, 'unbanning'])->name('unbanning');
Route::post('/unbanningSubmit', [ModeratorControllerDimitrije::class, 'unbanningSubmit'])->name('unbanningSubmit');
Route::get('/downgradeModerator', [AdminControllerDimitrije::class, 'downgradeModerator'])->name('downgradeModerator');
Route::post('/downgradeModeratorSubmit', [AdminControllerDimitrije::class, 'downgradeModeratorSubmit'])->name('downgradeModeratorSubmit');


Route::get('/auction/{id}/bidding', [RegistredControllerDimitrije::class, 'bidding'])->name('bidding');
Route::post('/auction/{id}/biddingSubmit', [RegistredControllerDimitrije::class, 'biddingSubmit'])->name('biddingSubmit');
Route::get('/auction/{id}/biddingBot', [RegistredControllerDimitrije::class, 'biddingBot'])->name('biddingBot');
Route::post('/auction/{id}/biddingBotSetup', [RegistredControllerDimitrije::class, 'biddingBotSetup'])->name('biddingBotSetup');
Route::get('/auction/{id}/cancel', [ModeratorControllerDimitrije::class, 'cancelAuction'])->name('cancelAuction');
Route::get('/exhibition/{id}/cancel', [ModeratorControllerDimitrije::class, 'cancelExhibition'])->name('cancelExhibition');

Route::get('/testing', [AdminControllerDimitrije::class, 'testing'])->name('testing');
