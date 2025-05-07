<?php
//46
use Illuminate\Foundation\Auth\EmailVerificationRequest;
//50
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
//15
Route::get('/', function () {
    return view('welcome');
})->name('home'); //16 в main.blade.php

//4 маршрут для показа формы регистрации
Route::get('register', [App\Http\Controllers\UserController::class, 'create'])->name('register');
//5 маршрут для приема данных
Route::post('register', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
//6 маршрут для показа формы входа
Route::get('login', [App\Http\Controllers\UserController::class, 'login'])->name('login');
//49
Route::get('dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');

//7 resourses/views создать папку user create.blade.php / login.blade.php

// 42 маршрут верификации из https://laravel.su/index.php/docs/11.x/verification
Route::get('/verify-email', function () {
    return view('user.verify-email');
})->middleware('auth')->name('verification.notice');
// 43 создаем вид user.verify-email



//47 из документации только поправим редайрект
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); //верифицируется email

    return redirect()->route('dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');
//48 usercontroller

//51 повторная отправка из документации + добавить в вид veryfy-email + добавить вывод сообщения в main.blade
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent again!');
})->middleware(['auth', 'throttle:3,1'])->name('verification.send');
//52 поправить редайрект в usercontroller
