<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\PhotosController;
// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\ResetPasswordController;
// use App\Http\Controllers\FormController;
// use App\Http\Controllers\UserManagementController;
// use App\Http\Controllers\LockScreen;
// use App\Http\Controllers\ProductController;

// --------------------------------------------------------------------------
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PDFInvItemsController;
use App\Http\Controllers\PDFinvDetailsController;

// --------------------------------------------------------------------------
use App\Http\Controllers\invReceiptListsController;
use App\Http\Controllers\invReceiptDetailsController;
use App\Http\Controllers\InvFiscalYearsController;
use App\Http\Controllers\InvMonthsController;
use App\Http\Controllers\invDetailController;
use App\Http\Controllers\Income2pageController;
use App\Http\Controllers\invItemsController;
use App\Http\Controllers\INVFiscalYearsExpensesController;
use App\Http\Controllers\INVMonthsExpensesController;
use App\Http\Controllers\INVDetailsExpensesController;
use App\Http\Controllers\INVItemsExpensesController;


Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', function () {
        return view('home');
    });
    Route::get('home', function () {
        return view('home');
    });
});

// Auth::routes();

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


// ----------------------------- form invReceiptLists ------------------------------//
Route::resource('invReceiptLists', invReceiptListsController::class)->middleware('auth');
Route::put('invReceiptLists/update/{id}', [invReceiptListsController::class, 'update'])->name('invReceiptLists.update')->middleware('auth');

// ----------------------------- form invReceiptDetails ------------------------------//
Route::resource('invReceiptDetails', invReceiptDetailsController::class)->middleware('auth');
Route::get('/invReceiptDetails/create/{id}', [invReceiptDetailsController::class, 'create004'])->name('create004')->middleware('auth');
Route::put('update_invReceiptDetails/{id}', [invReceiptDetailsController::class, 'update'])->name('update_invReceiptDetails')->middleware('auth');


// ----------------------------- form InvFiscalYears ------------------------------//
Route::resource('fiscal_years', InvFiscalYearsController::class)->middleware('auth');
Route::GET('fiscal_years/update/{id}', [InvFiscalYearsController::class, 'update'])->name('fiscal_years.update')->middleware('auth');

// ----------------------------- form InvFiscalYearsExpenses ------------------------------//
Route::resource('INV_fiscal_years_expenses', INVFiscalYearsExpensesController::class)->middleware('auth');
Route::GET('INV_fiscal_years_expenses/update/{id}', [INVFiscalYearsExpensesController::class, 'update'])->name('fiscal_years.update')->middleware('auth');

// ----------------------------- form InvMonths ------------------------------//
Route::resource('InvMonths', InvMonthsController::class)->middleware('auth');
Route::get('/InvMonths/create/{id}', [InvMonthsController::class, 'create001'])->name('create001')->middleware('auth');
Route::put('update_InvMonths/{id}', [InvMonthsController::class, 'update'])->name('update_InvMonths')->middleware('auth');
Route::delete('/InvMonths/destroy/{id}', [InvMonthsController::class, 'destroy'])->name('InvMonths.destroy')->middleware('auth');

// ----------------------------- form InvMonthsExpenses ------------------------------//
Route::resource('InvMonths_expenses', INVMonthsExpensesController::class)->middleware('auth');
Route::get('/InvMonths_expenses/create/{id}', [INVMonthsExpensesController::class, 'create001'])->name('create001')->middleware('auth');
Route::put('update_InvMonths_expenses/{id}', [INVMonthsExpensesController::class, 'update'])->name('update_InvMonths')->middleware('auth');
Route::delete('/InvMonths_expenses/destroy/{id}', [INVMonthsExpensesController::class, 'destroy'])->name('InvMonths.destroy')->middleware('auth');

// ----------------------------- form income2page ------------------------------//
Route::resource('income2page', Income2pageController::class)->middleware('auth');
Route::get('students/records', [Income2pageController::class, 'records'])->name('students/records');

// ----------------------------- form invDetails ------------------------------//
Route::resource('invDetails', invDetailController::class)->middleware('auth');
Route::get('/invDetails/create/{id}', [invDetailController::class, 'create002'])->name('create002')->middleware('auth');
Route::put('update_invDetails/{id}', [invDetailController::class, 'update'])->name('update_invDetails')->middleware('auth');

// ----------------------------- form invDetailsExpenses ------------------------------//
Route::resource('invDetails_expenses', INVDetailsExpensesController::class)->middleware('auth');
Route::get('/invDetails_expenses/create/{id}', [INVDetailsExpensesController::class, 'create002'])->name('create002')->middleware('auth');
Route::put('update_invDetails_expenses/{id}', [INVDetailsExpensesController::class, 'update'])->name('update_invDetails')->middleware('auth');

// ----------------------------- form invItems Image ------------------------------//
Route::resource('invItems', invItemsController::class)->middleware('auth');
Route::get('/invItems/create/{id}', [invItemsController::class, 'create003'])->name('create003')->middleware('auth');
Route::put('update_invItems/{id}', [invItemsController::class, 'update'])->name('update_invItems')->middleware('auth');

// ----------------------------- form invItems Expenses ------------------------------//
Route::resource('invItems_expenses', INVItemsExpensesController::class)->middleware('auth');
Route::get('/invItems_expenses/create/{id}', [INVItemsExpensesController::class, 'create003'])->name('create003')->middleware('auth');
Route::put('update_invItems_expenses/{id}', [INVItemsExpensesController::class, 'update'])->name('update_invItems')->middleware('auth');

// ----------------------------- form pdfdata ------------------------------//
Route::get('/pdf/{id}', [PDFController::class, 'pdf'])->middleware('auth');
Route::get('/pdfInvDetails/{id}', [PDFinvDetailsController::class, 'PDFInvDetails'])->middleware('auth');
Route::get('/pdfInvItems/{id}', [PDFInvItemsController::class, 'pdfInvItems'])->middleware('auth');

// ----------------------------- form dashboard ------------------------------//
Route::get('/api/dashboard', [App\Http\Controllers\HomeController::class, 'deshboard'])->name('api/dashboard');