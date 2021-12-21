<?php

use App\Http\Controllers\StudentController;
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


// Route::group(['domain' => 'admin.explore'], function () {
//     Route::get('/', function () {
//         return "I will only trigger when domain is admin.myapp.~dev.";
//     });
// });

Auth::routes();

Route::domain('admin.'.env('SITE_URL'))->group(function () {
    Route::group(['middleware' => ['auth', 'role:Admin']], function () {

            // dashboard/ or home
        Route::get('/', [App\Http\Controllers\superAdminController::class, 'index'])->name('dashboard.admin.index');

        // admin mgt
        Route::get('/create', [App\Http\Controllers\superAdminController::class, 'adminCreate'])->name('dashboard.admin.create');
        Route::get('/index', [App\Http\Controllers\superAdminController::class, 'index'])->name('dashboard.admin.index');
        Route::post('/post', [App\Http\Controllers\superAdminController::class, 'addAdmin'])->name('dashboard.admin.post');

        //school mgt
        Route::resource('/school', 'App\Http\Controllers\SchoolController');

            // download pins section 
        Route::get('/pin/download/{pin}', [App\Http\Controllers\PinController::class, 'download'])->name('pinDownload');
        // Request pin section 
        Route::resource('/pin',  'App\Http\Controllers\PinController');
        
    });
});



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    Route::get('/promote', [App\Http\Controllers\PromotionController::class, 'index'])->name('promote.index');
    Route::get('/promoteClass', [App\Http\Controllers\PromotionController::class, 'promote'])->name('promote');
    Route::resource('/student', 'App\Http\Controllers\StudentController');
    Route::resource('/class', 'App\Http\Controllers\KlassController');
});
