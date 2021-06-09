<?php

use App\Models\Active;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActiveController;
use App\Http\Controllers\ScripttagController;
use App\Http\Controllers\StudInsertController;
use App\Http\Controllers\PrductController;
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
    $actives = Active::get();
    // dd($actives);
          return view('welcome',compact('actives'));
    
})->middleware('auth.shopify')->name('home');

Route::get('/rest', 'ScripttagController@home')->middleware('auth.shopify')->name('rest');

//This will redirect user to login page.
Route::get('/login', function () {
    if (Auth::user()) {
        return redirect()->route('home');
    }
    return view('login');
})->name('login');

Route::get('/rest', 'ScripttagController@home')->middleware('auth.shopify')->name('rest');
Route::get('/status','ActiveController@index')->middleware('auth.shopify')->name('status');
Route::get('/changeStatus','ActiveController@changeUserStatus')->middleware('auth.shopify');
// Route::get('/update','PrductController@delete')->middleware('auth.shopify')->name('delete');

