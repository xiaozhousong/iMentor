<?php

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
    return redirect()->route('student.home');

});

Auth::routes();


Route::group(['namespace' => 'Student', 'middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('student.home');
    Route::get('/availabilities', 'AvailabilityController@index')->name('student.availabilities');
    Route::get('/availabilities/{id}', 'AvailabilityController@show')->name('student.availabilities.show');
    Route::post('/appointments', 'AppointmentController@book')->name('student.appointments.book');
    Route::get('/appointments', 'AppointmentController@index')->name('student.appointments.index');
    Route::post('/appointments/cancel', 'AppointmentController@cancel')->name('student.appointments.cancel');
});

Route::prefix('tutor')->group(function () {
    Route::get('/login', 'Auth\TutorLoginController@showLoginForm')->name('tutor.login');
    Route::post('/login', 'Auth\TutorLoginController@login')->name('tutor.login.submit');
    Route::get('/', 'TutorController@index')->name('tutor.dashboard');
});