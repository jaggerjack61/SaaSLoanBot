<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingsController;
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


Route::middleware('auth')->group(function(){
    Route::controller(MainController::class)->group(function(){

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

    Route::controller(SettingsController::class)->group(function(){
        Route::prefix('settings')->group(function(){
            Route::get('profile','showProfile')->name('show-profile');
            Route::post('profile','saveProfile')->name('save-profile');
            Route::get('admin','showAdmin')->name('show-admin');
        });
    });

    Route::controller(ReportsController::class)->group(function(){
        Route::prefix('reports')->group(function(){
            Route::get('payments','showPayments')->name('show-payments-report');
            Route::get('loans','showLoans')->name('show-loans');

        });
    });
});

