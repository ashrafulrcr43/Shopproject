<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TokenVerifyMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('userRegistration',[UserController::class, 'userRegistration']);
Route::post('userLogin',[UserController::class, 'userLogin']);
Route::post('sendOtp',[UserController::class, 'sendOtpCode']);
Route::post('verify-otp',[UserController::class, 'verifyOtp']);

//Token verify
Route::post('password-reset',[UserController::class, 'restPasword'])
->middleware([TokenVerifyMiddleware::class]);

// Page Route
Route::get('/userLogin',[UserController::class,'loginPage']);
Route::get('/userRegistation',[UserController::class,'registration']);
Route::get('/sendOtp',[UserController::class,'sendotp']);
Route::get('/varifyOtp',[UserController::class,'varifyOtp']);
Route::get('/passwordreset',[UserController::class,'passwordReset'])
->middleware([TokenVerifyMiddleware::class]);
Route::get('/logout',[UserController::class,'userLogout']);

Route::get('/dashboard',[DashboardController::class, 'dashboard'])
->middleware([TokenVerifyMiddleware::class]);

//profile detailes
Route::get('/user-profile',[UserController::class, 'userProfile'])
->middleware([TokenVerifyMiddleware::class]);
//profile update
Route::post('/user-update',[UserController::class, 'userProfileUpdate'])
->middleware([TokenVerifyMiddleware::class]);

Route::get('/userProfile',[UserController::class, 'uerProfilePage'])
->middleware([TokenVerifyMiddleware::class]);

//category 
Route::get('/categoryPage',[CategoryController::class, 'categoryPage'])
->middleware([TokenVerifyMiddleware::class]);

Route::get('categorylist',[CategoryController::class, 'categoryList'])
 ->middleware([TokenVerifyMiddleware::class]);
 Route::post('categorycreate',[CategoryController::class, 'categoryCreate'])
 ->middleware([TokenVerifyMiddleware::class]); 
 Route::post('categorydelete',[CategoryController::class, 'categoryDelete'])
 ->middleware([TokenVerifyMiddleware::class]); 

 Route::post('categoryupdate',[CategoryController::class, 'categoryUpdate'])
 ->middleware([TokenVerifyMiddleware::class]);
 
 Route::post('categoryById',[CategoryController::class, 'categoryById'])
 ->middleware([TokenVerifyMiddleware::class]);
 
 