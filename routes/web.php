<?php

use Illuminate\Support\Facades\Route;
use App\Events\DemoEvent;

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
    broadcast(new DemoEvent('data testing'));
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('messages', 'MessageController');
Route::get('/chat/{receiver}', 'MessageController@messageRoom');
Route::get('/chat/{receiver}/fetch', 'MessageController@fetchMessage');
Route::post('/chat/{receiver}/send', 'MessageController@sendMessage');
