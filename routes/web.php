<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\content\CategorieController;
use App\Http\Controllers\content\EntreeController;
use App\Http\Controllers\content\ProductController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
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
    Route::resource("categories", CategorieController::class);
    Route::resource("products", ProductController::class);
    // Route::resource("entree", EntreeController::class)->except("create");
    Route::get("history", HistoryController::class)->name("history");
    Route::controller(HomeController::class)->group(function () {
        Route::get('EntreeList', "EntreeList")->name("EntreeList");
        Route::post('addEntree', "AddEntree")->name("AddEntree");
        Route::get('SortieList', "SortieList")->name("SortieList");
        Route::post('AddSortie', "AddSortie")->name("AddSortie");
    });
});

Route::view('/login', 'auth.login')->name("login")->middleware("guest");

Route::get("products_of_categorie/", [HomeController::class, 'GetProductOfCategorie'])->name("productsOfCategorie");
Route::get("GetProductInfo/", [HomeController::class, 'GetProductInfo'])->name("GetProductInfo");

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
