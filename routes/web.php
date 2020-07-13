<?php

use Illuminate\Support\Facades\Route;
use App\Mail\HelloMail;
use Illuminate\Support\Facades\Mail;
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
    return view('app');
});

// Route::get('/email', function () {
//     Mail::to('raiyanpharon@gmail.com')->send(new HelloMail());
    
//     return new HelloMail();
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('api')->group(function () {
    Route::resource('customer', 'Api\CustomerController');
});
