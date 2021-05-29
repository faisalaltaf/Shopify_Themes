<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScripttagController;
use Facade\Ignition\Http\Controllers\ScriptController;

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
    
})->middleware('auth.shopify')->name('home');

Route::get('/rest', 'ScripttagController@home')->middleware('auth.shopify')->name('rest');

//This will redirect user to login page.
Route::get('/login', function () {
    if (Auth::user()) {
        return redirect()->route('home');
    }
    return view('login');
})->name('login');