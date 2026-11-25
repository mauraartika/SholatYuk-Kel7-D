<?php

use App\Http\Controllers\SharedStreakController;
use App\Services\StreakService;
use App\Http\Controllers\PertemananController;
use App\Http\Controllers\IbadahController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JenisIbadahController;
use App\Http\Controllers\SuaraAdzanController;

// Route::get('/', function () {
//     return view('home');
// });

// User Authentication

Route::get('/register', function () {
    return view('register');
})->name('register');
Route::get('/', function () {
    return view('login');
})->name('login');

// 2. Form Submission Endpoints linking to the AuthController
Route::post('/register', [AuthController::class, 'register']);
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Protected Dashboard (Only accessible after logging in)
Route::get('/home', function () {
    return view('home');
})->middleware('auth');

// Profile

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update-preferences', [ProfileController::class, 'updatePreferences']);

    Route::get('/pelacakan-ibadah', function () {
        return view('pelacakanibadah');
    });

    Route::get('/pengaturan-notifikasi', function () {
        return view('notifikasi-audio');
    });

    Route::get('/sholat-sunnah', function () {
        return view('sholatsunnah');
    });

    // Pelacakan ibadah
    Route::get('/api/ibadah', [IbadahController::class, 'index']);
    Route::post('/api/ibadah', [IbadahController::class, 'store']);

    Route::get('/masjid-terdekat', function () {
        return view('masjidterdekat');
    });

    Route::get('/arah-kiblat', function () {
        return view('arahkiblat');
    });

    Route::get('/leaderboard', function () {
        return view('leaderboard');
    });

    // Fitur Pertemanan
    Route::get('/teman', [PertemananController::class, 'index'])
        ->name('teman.index');

    Route::get('/teman/cari', [PertemananController::class, 'search'])
        ->name('teman.search');

    Route::post('/teman/kirim', [PertemananController::class, 'store'])
        ->name('teman.store');

    Route::post('/teman/{id}/terima', [PertemananController::class, 'accept'])
        ->name('teman.accept');

    Route::delete('/teman/{id}/tolak', [PertemananController::class, 'reject'])
        ->name('teman.reject');

    // Fitur Streak Bersama
    Route::get('/teman/{id}/streak', [
        SharedStreakController::class,
        'show'
    ])->name('teman.streak');

    Route::post('/teman/{id}/streak/pengingat', [
        SharedStreakController::class,
        'sendReminder'
    ])->name('teman.streak.pengingat');

    Route::get('/api/teman/{id}/streak', [
        SharedStreakController::class,
        'status'
    ])->name('api.teman.streak');

    // API Jenis Sholat Sunnah Khusus
    Route::get('/api/jenis-ibadah', [JenisIbadahController::class, 'index']);
    Route::post('/api/jenis-ibadah', [JenisIbadahController::class, 'store']);
    Route::put('/api/jenis-ibadah/{id}', [JenisIbadahController::class, 'update']);
    Route::delete('/api/jenis-ibadah/{id}', [JenisIbadahController::class, 'destroy']);

    // API suara adzan
    Route::get('/api/suara-adzan', [SuaraAdzanController::class, 'index']);
    Route::post('/api/suara-adzan', [SuaraAdzanController::class, 'store']);
    Route::delete('/api/suara-adzan/{id}', [SuaraAdzanController::class, 'destroy']);
    Route::post('/api/suara-adzan/select', [SuaraAdzanController::class, 'select']);
});
