<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\stefan\CreateExhibitionController;

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

Route::get('/createExhibition', [CreateExhibitionController::class,'createExhibition'])->name('createExhibition');

Route::get('/myExhibition', [CreateExhibitionController::class,'myExhibition']);

Route::post('/createExhibitionSubmit', [CreateExhibitionController::class, 'createExhibitionSubmit'])->name('createExhibitionSubmit');

