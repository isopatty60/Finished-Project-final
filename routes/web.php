<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\LockScreen;
use App\Http\Controllers\ProductController;

// --------------------------------------------------------------------------
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PDFIncome2Controller;
use App\Http\Controllers\PDFIncome3Controller;

// --------------------------------------------------------------------------
use App\Http\Controllers\PostController;
use App\Http\Controllers\Customer_listsController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\Income1Controller;
use App\Http\Controllers\Income2Controller;
use App\Http\Controllers\Income2pageController;
use App\Http\Controllers\Income3Controller;



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
    return view('auth.login');
});

Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('home');
    });
    Route::get('home',function()
    {
        return view('home');
    });
});

Auth::routes();

// ----------------------------- home dashboard ------------------------------//
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// -----------------------------login----------------------------------------//
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ----------------------------- lock screen --------------------------------//
Route::get('lock_screen', [App\Http\Controllers\LockScreen::class, 'lockScreen'])->middleware('auth')->name('lock_screen');
Route::post('unlock', [App\Http\Controllers\LockScreen::class, 'unlock'])->name('unlock');

// ------------------------------ register ---------------------------------//
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('register');

// ----------------------------- forget password ----------------------------//
Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'getEmail'])->name('forget-password');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postEmail'])->name('forget-password');

// ----------------------------- reset password -----------------------------//
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'getPassword']);
Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword']);

// ----------------------------- user profile ------------------------------//
Route::get('profile_user', [App\Http\Controllers\UserManagementController::class, 'profile'])->name('profile_user');
Route::post('profile_user/store', [App\Http\Controllers\UserManagementController::class, 'profileStore'])->name('profile_user/store');

// ----------------------------- user userManagement -----------------------//
Route::get('userManagement', [App\Http\Controllers\UserManagementController::class, 'index'])->middleware('auth')->name('userManagement');
Route::get('user/add/new', [App\Http\Controllers\UserManagementController::class, 'addNewUser'])->middleware('auth')->name('user/add/new');
Route::post('user/add/save', [App\Http\Controllers\UserManagementController::class, 'addNewUserSave'])->name('user/add/save');
Route::get('view/detail/{id}', [App\Http\Controllers\UserManagementController::class, 'viewDetail'])->middleware('auth');
Route::post('update', [App\Http\Controllers\UserManagementController::class, 'update'])->name('update');
Route::get('delete_user/{id}', [App\Http\Controllers\UserManagementController::class, 'delete'])->middleware('auth');
Route::get('activity/log', [App\Http\Controllers\UserManagementController::class, 'activityLog'])->middleware('auth')->name('activity/log');
Route::get('activity/login/logout', [App\Http\Controllers\UserManagementController::class, 'activityLogInLogOut'])->middleware('auth')->name('activity/login/logout');

Route::get('change/password', [App\Http\Controllers\UserManagementController::class, 'changePasswordView'])->middleware('auth')->name('change/password');
Route::post('change/password/db', [App\Http\Controllers\UserManagementController::class, 'changePasswordDB'])->name('change/password/db');

// ----------------------------- form staff ------------------------------//
Route::get('form/staff/new', [App\Http\Controllers\FormController::class, 'index'])->middleware('auth')->name('form/staff/new');
Route::post('form/save', [App\Http\Controllers\FormController::class, 'saveRecord'])->name('form/save');
Route::get('form/view/detail', [App\Http\Controllers\FormController::class, 'viewRecord'])->middleware('auth')->name('form/view/detail');
Route::get('form/view/detail/{id}', [App\Http\Controllers\FormController::class, 'viewDetail'])->middleware('auth');
Route::post('form/view/update', [App\Http\Controllers\FormController::class, 'viewUpdate'])->name('form/view/update');
Route::get('delete/{id}', [App\Http\Controllers\FormController::class, 'viewDelete'])->middleware('auth');

// ----------------------------- form Test ------------------------------//

Route::resource('posts', PostController::class)->middleware('auth');
Route::resource('customer_lists', Customer_listsController::class)->middleware('auth');
Route::get('/customer_lists/create/{id}', [Customer_listsController::class , 'create004'])->name('create004')->middleware('auth');

Route::put('update_customer/{id}', [Customer_listsController::class, 'update'])->name('update_customer')->middleware('auth');


// ----------------------------- form Income ------------------------------//
Route::resource('incomes', IncomeController::class)->middleware('auth');

// ----------------------------- form Income1 ------------------------------//
Route::resource('income1', Income1Controller::class)->middleware('auth');
Route::get('/income1/create/{id}', [Income1Controller::class , 'create001'])->name('create001')->middleware('auth');

Route::put('update_income1/{id}', [Income1Controller::class, 'update'])->name('update_income1')->middleware('auth');

// ----------------------------- form income2page ------------------------------//
Route::resource('income2page', Income2pageController::class)->middleware('auth');
Route::get('students/records', [Income2pageController::class, 'records'])->name('students/records');

// ----------------------------- form Income2 ------------------------------//
Route::resource('income2', Income2Controller::class)->middleware('auth');
Route::get('/income2/create/{id}', [Income2Controller::class , 'create002'])->name('create002')->middleware('auth');

Route::put('update_income2/{id}', [Income2Controller::class, 'update'])->name('update_income2')->middleware('auth');

// ----------------------------- form Income3 Image ------------------------------//
Route::resource('income3', Income3Controller::class)->middleware('auth');
Route::get('/income3/create/{id}', [Income3Controller::class , 'create003'])->name('create003')->middleware('auth');

Route::put('update_income3/{id}', [Income3Controller::class, 'update'])->name('update_income3')->middleware('auth');

// ----------------------------- form pdfdata ------------------------------//
Route::get('/pdf/{id}', [PDFController::class , 'pdf'])->middleware('auth');
Route::get('/PDFIncome2/{id}', [PDFIncome2Controller::class , 'PDFIncome2'])->middleware('auth');
Route::get('/pdfIncome3/{id}', [PDFIncome3Controller::class , 'pdfIncome3'])->middleware('auth');



