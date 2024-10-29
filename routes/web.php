<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
