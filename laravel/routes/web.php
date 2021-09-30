<?php

use App\Http\Controllers\BookingController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', function(){
    return "Second Route test";
});

Route::get('/rooms/{roomType?}', [\App\Http\Controllers\ShowRoomsController::class, '__invoke']); //this means we have a route rooms which points to the showrooms controller and it has an optional roomtype params indicated by the ?

// Route::get('/bookings', [\App\Http\Controllers\BookingController@index::class, '__invoke']);

// Route::get('/bookings', [\App\Http\Controllers\BookingsController::class, 'index','__invoke']);

Route::resource('/bookings', BookingController::class);