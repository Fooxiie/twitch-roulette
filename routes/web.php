<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BugController;
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
Route::get('/getjeton', [TwitchController::class, 'getJeton'])->middleware(['auth'])->name('auth.wizebot.jeton');
Route::post('/profil/activeKey', [TwitchController::class, 'activeKey'])->middleware(['auth'])->name('auth.twitch.profil.activateKey');

Route::get('/room', function () {
    return view('room.room');
})->middleware(['auth', 'role:streamer|super-admin'])->name('room');
Route::get('/room/submit',              [GameController::class, 'submit'])->middleware(['auth'])->name('room.submit');
Route::get('/room/play', [GameController::class, 'play'])->middleware(['auth', 'role:streamer|super-admin'])->name('room.play');
Route::get('/room/playAsGuest', [GameController::class, 'playAsGuest'])->middleware(['auth', 'role:viewer|streamer|moderator|super-admin'])->name('room.play.guest');
Route::get('/room/iwanttosit', [GameController::class, 'sit_at_table'])->middleware(['auth'])->name('room.sit');
Route::get('/room/removeParticipant', [GameController::class, 'remove_sit'])->middleware(['auth'])->name('room.sit.remove');

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
Route::post('/admin/edit/create/key/submit', [AdminController::class, 'keyGenerateSubmit'])->middleware(['auth', 'permission:generateKey'])->name('admin.generate.key');
Route::get('/admin/list/user', [AdminController::class, 'listUsers'])->middleware(['auth', 'permission:see users'])->name('admin.list.user');

Route::get('/bugreporter', [BugController::class, 'report'])->middleware(['auth'])->name('bug.report');
Route::post('/bugreporter/submit', [BugController::class, 'report_submit'])->middleware(['auth'])->name('bug.report.submit');
Route::get('/bugreporter/submited', [BugController::class, 'report_submited'])->middleware(['auth'])->name('bug.bug_submited');

Route::get('/errors/403', function () {
    return view('errors.403');
});


require __DIR__ . '/auth.php';
