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
use App\Http\Controllers\PDFinvDetailExpensesController;
use App\Http\Controllers\PDFInvItemsExpensesController;



// --------------------------------------------------------------------------
use App\Http\Controllers\invReceiptListsController;
use App\Http\Controllers\invReceiptDetailsController;
use App\Http\Controllers\InvFiscalYearsController;
use App\Http\Controllers\InvMonthsController;
use App\Http\Controllers\invDetailController;
use App\Http\Controllers\Income2pageController;
use App\Http\Controllers\invItemsController;
use App\Http\Controllers\invFiscalYearExpensesController;
use App\Http\Controllers\invMonthExpensesController;
use App\Http\Controllers\invDetailExpensesController;
use App\Http\Controllers\invItemExpensesController;

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
Route::get('invFiscalYearExpenses/edit/{id}', [invReceiptListsController::class, 'edit'])->name('invReceiptLists.edit')->middleware('auth');
Route::post('invReceiptLists/update/{id}', [invReceiptListsController::class, 'update'])->name('invReceiptLists.update')->middleware('auth');

// ----------------------------- form invReceiptDetails ------------------------------//
Route::resource('invReceiptDetails', invReceiptDetailsController::class)->middleware('auth');
Route::get('/invReceiptDetails/create/{id}', [invReceiptDetailsController::class, 'createInvReceiptDetails'])->name('createInvReceiptDetails')->middleware('auth');
Route::post('update_invReceiptDetails/{id}', [invReceiptDetailsController::class, 'update'])->name('update_invReceiptDetails')->middleware('auth');


// ----------------------------- form InvFiscalYears ------------------------------//
Route::resource('fiscal_years', invFiscalYearsController::class)->middleware('auth');
Route::put('fiscal_years/update/{id}', [invFiscalYearsController::class, 'update'])->name('fiscal_years.update')->middleware('auth');

// ----------------------------- form InvFiscalYearsExpenses ------------------------------//
Route::resource('invFiscalYearExpenses', invFiscalYearExpensesController::class)->middleware('auth');
Route::get('invFiscalYearExpenses/edit/{id}', [invFiscalYearExpensesController::class, 'edit'])->name('invFiscalYearExpenses.edit')->middleware('auth');
Route::post('invFiscalYearExpenses/update/{id}', [invFiscalYearExpensesController::class, 'update'])->name('invFiscalYearExpenses.update')->middleware('auth');
Route::delete('/invFiscalYearExpenses/destroy/{id}', [invFiscalYearExpensesController::class, 'destroy'])->name('invFiscalYearExpenses.destroy')->middleware('auth');

// ----------------------------- form InvMonths ------------------------------//
Route::resource('InvMonths', InvMonthsController::class)->middleware('auth');
Route::get('/InvMonths/create/{id}', [InvMonthsController::class, 'createInvMonths'])->name('createInvMonths')->middleware('auth');
Route::put('update_InvMonths/{id}', [InvMonthsController::class, 'update'])->name('update_InvMonths')->middleware('auth');
Route::delete('/InvMonths/destroy/{id}', [InvMonthsController::class, 'destroy'])->name('InvMonths.destroy')->middleware('auth');

// ----------------------------- form InvMonthsExpenses ------------------------------//
Route::resource('invMonthExpenses', invMonthExpensesController::class)->middleware('auth');
Route::get('/invMonthExpenses/create/{id}', [invMonthExpensesController::class, 'createInvMonthsExpenses'])->name('createInvMonthsExpenses')->middleware('auth');
Route::put('update_invMonthExpenses/{id}', [invMonthExpensesController::class, 'updateInvMonthExpenses'])->name('updateInvMonthExpenses')->middleware('auth');
Route::delete('/invMonthExpenses/destroy/{id}', [invMonthExpensesController::class, 'destroy'])->name('InvMonths.destroy')->middleware('auth');

// ----------------------------- form invDetails ------------------------------//
Route::resource('invDetails', invDetailController::class)->middleware('auth');
Route::get('/invDetails/create/{id}', [invDetailController::class, 'createInvDetails'])->name('createInvDetails')->middleware('auth');
Route::put('update_invDetails/{id}', [invDetailController::class, 'update'])->name('update_invDetails')->middleware('auth');

// ----------------------------- form invDetails Expenses ------------------------------//
Route::resource('invDetailExpenses', invDetailExpensesController::class)->middleware('auth');
Route::get('/invDetailExpenses/create/{id}', [invDetailExpensesController::class, 'createInvDetailExpenses'])->name('createInvDetailExpenses')->middleware('auth');
Route::put('updateInvDetailExpenses/{id}', [invDetailExpensesController::class, 'updateInvDetailExpenses'])->name('updateInvDetailExpenses')->middleware('auth');

// ----------------------------- form invItems Image ------------------------------//
Route::resource('invItems', invItemsController::class)->middleware('auth');
Route::get('/invItems/create/{id}', [invItemsController::class, 'createInvItems'])->name('createInvItems')->middleware('auth');
Route::put('update_invItems/{id}', [invItemsController::class, 'update'])->name('update_invItems')->middleware('auth');

// ----------------------------- form invItems Image Expenses ------------------------------//
Route::resource('invItemExpenses', invItemExpensesController::class)->middleware('auth');
Route::get('/invItemExpenses/create/{id}', [invItemExpensesController::class, 'createInvItemExpenses'])->name('createInvItemExpenses')->middleware('auth');
Route::put('updateInvItemExpenses/{id}', [invItemExpensesController::class, 'updateInvItemExpenses'])->name('updateInvItemExpenses')->middleware('auth');

// ----------------------------- form pdfdata ------------------------------//
Route::get('/pdf/{id}', [PDFController::class, 'pdf'])->middleware('auth');
Route::get('/pdfInvDetails/{id}', [PDFinvDetailsController::class, 'PDFInvDetails'])->middleware('auth');
Route::get('/pdfInvItems/{id}', [PDFInvItemsController::class, 'pdfInvItems'])->middleware('auth');
Route::get('/pdfInvDetailExpenses/{id}', [PDFinvDetailExpensesController::class, 'pdfInvDetailExpenses'])->middleware('auth');
Route::get('/pdfInvItemExpenses/{id}', [PDFInvItemsExpensesController::class, 'pdfInvItemExpenses'])->middleware('auth');

// ----------------------------- form income2page ------------------------------//
Route::resource('income2page', Income2pageController::class)->middleware('auth');
