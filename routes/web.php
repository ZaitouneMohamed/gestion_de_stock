<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Mail;
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


Route::prefix("admin")->middleware("auth")->group(function () {
    Route::view('/', 'admin.index');
});

Route::view('/login', 'auth.login')->name("login");

Route::get('/mail', function () {
    $recipient = 'dwm23-zaitoune@ifiag.com';
    $subject = 'Demo Email';
    $content = 'Hello there! This is a demo email sent from Laravel.';

    Mail::raw($content, function ($message) use ($recipient, $subject) {
        $message->to($recipient);
        $message->subject($subject);
    });
});

Route::controller(AuthController::class)->name("auth.")->group(function () {
    Route::post("login", "login")->name("login");
    Route::get("logout", "logout")->name("logout");
});
