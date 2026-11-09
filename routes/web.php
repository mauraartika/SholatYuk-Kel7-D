
<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/masjid-terdekat', function () {
    return view('masjidterdekat');
});

Route::get('/arah-kiblat', function () {
    return view('arahkiblat');
});
Route::get('/leaderboard', function () {
    return view('leaderboard');
});

Route::get('/pengaturan-notifikasi', function () {
    return view('notifikasi-audio');
});

Route::get('/pelacakan-ibadah', function () {
    return view('pelacakanibadah');
});

Route::get('/sholat-sunnah', function () {
    return view('sholatsunnah');
});


// User Authentication

Route::get('/register', function () { return view('register'); })->name('register');
Route::get('/', function () { return view('login'); })->name('login');

// 2. Form Submission Endpoints linking to the AuthController
Route::post('/register', [AuthController::class, 'register']);
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Protected Dashboard (Only accessible after logging in)
Route::get('/home', function () {
    return view('home');
})->middleware('auth');


// Profile


// Pastikan route ini berada di dalam grup middleware 'auth'
Route::middleware(['auth'])->group(function () {

    // Route untuk menampilkan halaman profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Route untuk memproses form update preferensi
    Route::put('/profile/update-preferences', [ProfileController::class, 'updatePreferences']);

});

