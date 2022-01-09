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


Auth::routes();
//everyone should have access to this but stuff will only be accessible if they are logged in

//Route::domain('admin.'.env('SITE_URL'))->group(function () {
Route::group(['middleware' => ['auth', 'role:SuperAdmin']], function () {

    // dashboard/ or home
    Route::get('/', [App\Http\Controllers\superAdminController::class, 'index'])->name('dashboard');

    // dashboard/SuperAdmin
    Route::get('/index', [App\Http\Controllers\superAdminController::class, 'index'])->name('dashboard.admin.index');
    
    // admin mgt
    Route::get('/create', [App\Http\Controllers\superAdminController::class, 'adminCreate'])->name('dashboard.admin.create');
    
    Route::post('/post', [App\Http\Controllers\superAdminController::class, 'addAdmin'])->name('dashboard.admin.post');

    Route::get('/admin/view', [App\Http\Controllers\superAdminController::class, 'ViewAdmin'])->name('dashboard.admin.view');

    //school mgt
    Route::resource('/school', 'App\Http\Controllers\SchoolController');

    // download pins section 
    Route::get('/pin/download/{pin}', [App\Http\Controllers\PinController::class, 'download'])->name('pinDownload');
    // Request pin section 
    Route::resource('/pin',  'App\Http\Controllers\PinController');

    // Session section
    Route::resource('/session',  'App\Http\Controllers\SessionController');
});
//});


Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    // dashboard/ or home
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/promote', [App\Http\Controllers\PromotionController::class, 'index'])->name('promote.index');
    Route::get('/promoteClass', [App\Http\Controllers\PromotionController::class, 'promote'])->name('promote');
    Route::resource('/student', 'App\Http\Controllers\StudentController');
    Route::resource('/class', 'App\Http\Controllers\KlassController');
});
