<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;


// // API-маршруты (если нужны)
// Route::apiResource('posts', PostController::class)->except(['index']);

// Route::get('/', function () {
//     return view('welcome');
// })->name('home'); 


// Главная страница
Route::get('/', [PostController::class, 'homepage'])->name('home');

// Полный RESTful API-набор маршрутов для posts
/* Список постов */ Route::get('posts', [PostController::class, 'index'])->name('posts.index');
/* Форма создания поста */ Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
/* Сохранение нового поста */ Route::post('posts', [PostController::class, 'store'])->name('posts.store');
/* Просмотр одного поста через slug*/ Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');// нужен метод getRouteKeyName()
// /* Форма редактирования поста */ Route::get('posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
// /* Обновление поста */ Route::put('posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
// /* Удаление поста */ Route::delete('posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');
// /* AJAX обновление рейтинга*/Route::patch('posts/{post:slug}/rate', [PostController::class, 'updateRating'])->name('posts.rate');

// добавить middleware 



Route::middleware('guest')->group(function () {
    Route::get('register', [UserController::class, 'create'])->name('register');
    Route::post('register', [UserController::class, 'store'])->name('users.store');

    Route::get('login', [UserController::class, 'login'])->name('login');  
    Route::post('login', [UserController::class, 'loginAuth'])->name('login.auth');
    
    Route::get('forgot-password', function () {
        return view('users.forgot-password');
    })->name('password.request');
    
    Route::post('forgot-password', [UserController::class, 'forgotPasswordStore'])->middleware('throttle:3,1')->name('password.email');
 
    Route::get('reset-password/{token}', function (string $token) {
        return view('users.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('reset-password', [UserController::class, 'resetPasswordUpdate'])->name('password.update');
});

// Route::get('dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('verify-email', function () {
        return view('users.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('dashboard');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent again!');
    })->middleware('throttle:3,1')->name('verification.send');   
   
    Route::get('logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');

    Route::get('dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->middleware('verified')->name('dashboard');
   

});
