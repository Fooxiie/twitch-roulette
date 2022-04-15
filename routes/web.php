<?php

use App\Http\Controllers\TwitchController;
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
})->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('auth.twitch.connected');
})->middleware(['auth'])->name('dashboard');

Route::get('/auth/twitch/redirect',     [TwitchController::class, 'redirect'])->name('auth.twitch.redirect');
Route::get('/auth/twitch/callback',     [TwitchController::class, 'callback'])->name('auth.twitch.callback');
Route::get('/connected',                [TwitchController::class, 'connected'])->middleware(['auth'])->name('auth.twitch.connected');
Route::get('/profil',                   [TwitchController::class, 'profil'])->middleware(['auth'])->name('auth.twitch.profil');
Route::get('/profil/save',              [TwitchController::class,'save'])->middleware(['auth'])->name('auth.twitch.profil.save');

require __DIR__.'/auth.php';
