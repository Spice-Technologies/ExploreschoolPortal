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
//         return "I will only trigger when domain is admin.myapp.dev.";
//     });
// });

Auth::routes();

Route::domain('admin.explore')->group(function () {
      Route::get('/', function () {
        return "I will only trigger when domain is admin.explore.";
    });
});


Route::get('/', function () {
    return view('welcome');~
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::middleware('web')->domain('admin.' . env('SITE_URL'))->group(function () {
//     Route::get('/', function () {
//         return "I will only trigger when domain is admin.myapp.dev.";
//     });
// });

// Route::domain('{admin}.explore')->group(function () {
//     return "this is the super admin section for this app" ;
// });

Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    Route::get('/promote', [App\Http\Controllers\PromotionController::class, 'index'])->name('promote.index');
    Route::get('/promoteClass', [App\Http\Controllers\PromotionController::class, 'promote'])->name('promote');
    Route::resource('/student', 'App\Http\Controllers\StudentController');
    Route::resource('/class', 'App\Http\Controllers\KlassController');
});
