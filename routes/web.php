<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
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
    Route::get('/superAdmin', [App\Http\Controllers\superAdminController::class, 'index'])->name('dashboard');

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
    Route::resource('/pin', 'App\Http\Controllers\PinController');

    // Session section
    Route::resource('/session', 'App\Http\Controllers\SessionController');
    // Subject Management
    Route::resource('/subject', 'App\Http\Controllers\SubjectController');
});
//});

Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    // dashboard/ or home
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/promote', [App\Http\Controllers\PromotionController::class, 'index'])->name('promote.index');


    //class promotion controller  promote.klass.index
    Route::get('/promote/individual', [App\Http\Controllers\KlassPromotionController::class, 'index'])->name('promote.klass.index');
    Route::post('/promote/individual/submit', [App\Http\Controllers\KlassPromotionController::class, 'promote'])->name('promote.klass.promote');

    // mass promotion
    Route::post('/promote/class', [App\Http\Controllers\PromotionController::class, 'promote'])->name('promote');

    //individual Promotion
    Route::get('/promote/class/individual', [App\Http\Controllers\IndividualPromotionController::class, 'index'])->name('promote.individual.index');

    Route::post('/promote/class/individual/submit', [App\Http\Controllers\IndividualPromotionController::class, 'promote'])->name('promote.individual.promote');


    //Manage results
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard.admin');

    // Import  results
    Route::get('/import', [App\Http\Controllers\ResultController::class, 'index'])->name('import.upload');
    Route::post('/admin/result/import', [App\Http\Controllers\ResultController::class, 'importResult'])->name('dashboard.admin.importPost');
    Route::get('/admin/result/master', [App\Http\Controllers\ResultController::class, 'master'])->name('result.masterResult');
    Route::post('/admin/result/single', [App\Http\Controllers\ResultController::class, 'importResult'])->name('dashboard.admin.importPost');

    //master result sheet printing
    Route::resource('/admin/master/Mresult', 'App\Http\Controllers\AdminResultController');

    // admin prinitng of single sheet result 
    Route::resource('/admin/master/Sresult', 'App\Http\Controllers\adminSingleResult');
    Route::get('/admin/result/Sresult', [App\Http\Controllers\adminSingleResult::class, 'showResult'])->name('result.singleResult');
    // end print result 

    //manage students
    Route::resource('/student', 'App\Http\Controllers\StudentController');
    Route::post('/students/add/csv', [App\Http\Controllers\CsvStudentController::class, 'store'])->name('student.add.csv');

    Route::get('/students/csv', [App\Http\Controllers\CsvStudentController::class, 'index'])->name('student.csv.index');
    //graduates

    Route::get('/graduates', [App\Http\Controllers\GraduateController::class, 'index'])->name('graduate');

    // manage class
    Route::resource('/class', 'App\Http\Controllers\KlassController');

    // settings 
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');

    Route::post('/settings/store', [App\Http\Controllers\SettingsController::class, 'store'])->name('settings.store');

    // demote
    Route::get('/action/demote', [App\Http\Controllers\DemotionController::class, 'demoteIndex'])->name('action.demote');
    //repromote
    Route::get('/action/repromote', [App\Http\Controllers\DemotionController::class, 'repromoteIndex'])->name('action.repromote');

    Route::post('/demote/action', [App\Http\Controllers\DemotionController::class, 'action'])->name('demote.action');
});

Route::group(['middleware' => ['auth', 'role:Student']], function () {
    // dashboard/ or home
    Route::get('/user/printPDf', [App\Http\Controllers\PrintResultController::class, 'printPDf'])->name('printPDf');
    Route::get('/user', [App\Http\Controllers\SoleStudentController::class, 'index'])->name('student.user.index');
    Route::resource('/student/result', 'App\Http\Controllers\checkResultController');
});
