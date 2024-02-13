<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistrationController;

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

Route::get('/register/step1', 'RegistrationController@step1');
Route::post('/register/step1', 'RegistrationController@postStep1');
Route::get('/register/step2', 'RegistrationController@step2');
Route::post('/register/step2', 'RegistrationController@postStep2');
Route::post('/verify-otp', 'RegistrationController@verifyOtp')->name('verify-otp');

Route::group(['middleware' => 'multiStep'], function () {
    Route::get('/register/step2', 'RegistrationController@step2');
    Route::post('/register/step2', 'RegistrationController@postStep2');
});

