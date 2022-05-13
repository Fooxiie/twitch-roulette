<?php

use App\Http\Controllers\GameController;
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
    return view('auth.twitch.connected');
})->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('auth.twitch.connected');
})->middleware(['auth'])->name('dashboard');

Route::get('/auth/twitch/redirect',     [TwitchController::class, 'redirect'])->name('auth.twitch.redirect');
Route::get('/auth/twitch/callback',     [TwitchController::class, 'callback'])->name('auth.twitch.callback');
Route::get('/connected',                [TwitchController::class, 'connected'])->middleware(['auth'])->name('auth.twitch.connected');
Route::get('/profil',                   [TwitchController::class, 'profil'])->middleware(['auth'])->name('auth.twitch.profil');
Route::get('/profil/save',              [TwitchController::class,'save'])->middleware(['auth'])->name('auth.twitch.profil.save');
Route::get('/getjeton',                 [TwitchController::class, 'getJeton'])->middleware(['auth'])->name('auth.wizebot.jeton');

Route::get('/room', function () {
    return view('room.room');
})->middleware(['auth'])->name('room');
Route::get('/room/submit',              [GameController::class, 'submit'])->middleware(['auth'])->name('room.submit');
Route::get('/room/play',                [GameController::class, 'play'])->middleware(['auth'])->name('room.play');

Route::get('/test',                     [GameController::class, 'test'])->middleware(['auth'])->name('test');
Route::get('/test/table',               [GameController::class, 'table'])->middleware(['auth'])->name('table');
Route::get('/game/test/saveform',       [GameController::class, 'form_result_addbet'])->middleware(['auth'])->name('form.test');
Route::get('/test/spinRoulette',        [GameController::class, 'spinRoulette'])->middleware(['auth'])->name('test.spin');
Route::get('/test/verifbet',            [GameController::class, 'verif_bet_for_game'])->middleware(['auth'])->name('test.verifbet');

require __DIR__.'/auth.php';
