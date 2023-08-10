<?php

use App\Http\Controllers\Auth\AuthController;
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

Route::permanentRedirect('/', '/admin');


Route::prefix("admin")->middleware("auth")->group(function(){
    Route::view('/', 'admin.index');
});
// 0710750199

Route::view('/login', 'auth.login')->name("login");

Route::controller(AuthController::class)->name("auth.")->group(function(){
    Route::post("login","login")->name("login");
    Route::get("logout","logout")->name("logout");
});
