<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
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
