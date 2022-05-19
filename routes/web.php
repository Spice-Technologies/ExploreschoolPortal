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
    // Subject Management 
    Route::resource('/subject',  'App\Http\Controllers\SubjectController');
});
//});

Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    // dashboard/ or home
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/promote', [App\Http\Controllers\PromotionController::class, 'index'])->name('promote.index');
    Route::get('/promoteClass', [App\Http\Controllers\PromotionController::class, 'promote'])->name('promote');

    //Manage results
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard.admin');

    // Import  results
    Route::get('/import', [App\Http\Controllers\ResultController::class, 'index'])->name('import.upload');
    Route::post('/admin/result/import', [App\Http\Controllers\ResultController::class, 'importResult'])->name('dashboard.admin.importPost');
    Route::get('/admin/result/master', [App\Http\Controllers\ResultController::class, 'master'])->name('result.masterResult');
    Route::post('/admin/result/single', [App\Http\Controllers\ResultController::class, 'importResult'])->name('dashboard.admin.importPost');
    Route::get('/admin/result/masterGen', [App\Http\Controllers\ResultController::class, 'masterPdfGen'])->name('result.masterPdfGen');


    //manage students
    Route::resource('/student', 'App\Http\Controllers\StudentController');

    // manage class
    Route::resource('/class', 'App\Http\Controllers\KlassController');
});

Route::group(['middleware' => ['auth', 'role:Student']], function () {

    // dashboard/ or home
    Route::get('/printPDf', [App\Http\Controllers\PrintResultController::class, 'printPDf'])->name('printPDf');
    Route::get('/user', [App\Http\Controllers\SoleStudentController::class, 'index'])->name('student.user.index');
    Route::resource('/student/result', 'App\Http\Controllers\checkResultController');
});
