<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
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

Route::controller(AuthController::class)->group(function(){
    Route::get('login','showLogin')->name('show-login');
    Route::post('login','login')->name('login');
    Route::get('logout','logout')->name('logout')->middleware('auth');

});
Route::controller(MainController::class)->middleware('auth')->group(function(){

    Route::get('dashboard','showDashboard')->name('dashboard');

    Route::prefix('pending')->group(function(){
        Route::get('users','showPendingUsers')->name('pending-users');
        Route::get('loans','showPendingLoans')->name('pending-loans');
    });
    Route::prefix('approved')->group(function(){
        Route::get('users','showRegisteredUsers')->name('registered-users');
        Route::get('loans','showApprovedLoans')->name('approved-loans');
    });
    Route::prefix('denied')->group(function(){
        Route::get('users','showDeniedUsers')->name('denied-users');
        Route::get('loans','showDeniedLoans')->name('denied-loans');
    });
    Route::get('completed/loans','showCompletedLoans')->name('completed-loans');
    Route::get('defaulted/loans','showDefaultedLoans')->name('defaulted-loans');



});
