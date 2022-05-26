<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Inertia\Inertia;
use App\Http\Controllers;

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

Route::get('/', 'PostController@index')->name('index');
Route::get('post/', 'PostController@search')->name('search');
Route::post('create/', 'PostController@store')->middleware('auth')->name('store');
Route::get('view/{id}', 'PostController@show')->name('view');
Route::post('view/{id}/comments', 'CommentController@store')->middleware('auth')->name('commentCreate');
Route::delete('view/{id}/comments', 'CommentController@destroy')->middleware('auth')->name('commentDestroy');
Route::post('/{id}/like', 'LikeController@store')->middleware('auth')->name('likeCreate');
Route::post('view/{id}/like', 'LikeController@storeView')->middleware('auth')->name('likeViewCreate');
Route::patch('view/{id}', 'PostController@update')->middleware('auth')->name('update');
Route::delete('view/{id}', 'PostController@destroy')->middleware('auth')->name('destroy');


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
    
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('dashboard/', function () {
        return view('dashboard');
    })->name('dashboard');
});


