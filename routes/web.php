<?php

use App\Http\Controllers\AdminController;
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
    return redirect(route('dashboard'));
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
})->middleware(['auth', 'role:streamer|super-admin'])->name('room');
Route::get('/room/submit',              [GameController::class, 'submit'])->middleware(['auth'])->name('room.submit');
Route::get('/room/play',                [GameController::class, 'play'])->middleware(['auth', 'role:streamer|super-admin'])->name('room.play');

Route::get('/test', [GameController::class, 'test'])->middleware(['auth'])->name('test');
Route::get('/test/table', [GameController::class, 'table'])->middleware(['auth'])->name('table');
Route::get('/game/test/saveform', [GameController::class, 'form_result_addbet'])->middleware(['auth'])->name('form.test');
Route::get('/test/spinRoulette', [GameController::class, 'spinRoulette'])->middleware(['auth'])->name('test.spin');
Route::get('/test/verifbet', [GameController::class, 'verif_bet_for_game'])->middleware(['auth'])->name('test.verifbet');

Route::get('/admin', [AdminController::class, 'show'])->middleware(['auth', 'role:super-admin|moderator'])->name('admin.show');
Route::get('/admin/delete/room', [AdminController::class, 'deleteRoom'])->middleware(['auth', 'permission:delete games'])->name('admin.delete.room');
Route::get('/admin/delete/user', [AdminController::class, 'deleteUser'])->middleware(['auth', 'permission:delete users'])->name(('admin.delete.user'));
Route::get('/admin/edit/user', [AdminController::class, 'editUser'])->middleware(['auth', 'permission:edit users'])->name('admin.edit.user');
Route::post('/admin/edit/user/submit', [AdminController::class, 'editUserSubmit'])->middleware(['auth', 'permission:edit users'])->name('admin.edit.user.submit');

Route::get('/errors/403', function () {
    return view('errors.403');
});


require __DIR__ . '/auth.php';
