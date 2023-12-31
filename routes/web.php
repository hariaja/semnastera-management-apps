<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ParticipantController;
use App\Http\Controllers\Activities\ProgramController;
use App\Http\Controllers\Activities\ScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'permission', 'verified'])->group(function () {
  Route::prefix('settings')->group(function () {
    // Role management.
    Route::resource('roles', RoleController::class)->except('show');

    // User management.
    Route::patch('users/status/{user}', [UserController::class, 'status'])->name('users.status');
    Route::post('users/image/delete/{user}', [UserController::class, 'image'])->name('users.image');
    Route::resource('users', UserController::class);

    // Paticipant management.
    Route::prefix('users')->group(function () {
      Route::resource('participants', ParticipantController::class)->except('index', 'destroy', 'show');
    });
  });

  // Management password users.
  Route::get('users/password/{user}', [PasswordController::class, 'showChangePasswordForm'])->name('users.password');
  Route::post('users/password', [PasswordController::class, 'store']);

  // Journals
  Route::prefix('activities')->group(function () {
    // Program atau Kegiatan
    Route::resource('programs', ProgramController::class);

    // Jadwal Acara atau Agenda Kegiatan
    Route::resource('schedules', ScheduleController::class);
  });
});
