<?php

use App\Http\Controllers\SubscribeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware('auth','check.device.limit')->name('home');

Route::post('/logout', function (Request $request) {
    // Laravel Fortify menangani logout, kita hanya tambahkan middleware
    return app(\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class)->destroy($request);
})->middleware(['auth', 'logout.device'])->name('logout');


Route::get('/subscribe/plans', [SubscribeController::class,'show'])->name('subscribe.show');
Route::post('/subscribe/plan/checkout', [SubscribeController::class,'checkout'])->name('subscribe.checkout');
Route::get('/subscribe/plan/success', [SubscribeController::class,'success'])->name('subscribe.success');
Route::get('/subscribe/plan/{plan}', [SubscribeController::class,'plan'])->name('subscribe.plan');