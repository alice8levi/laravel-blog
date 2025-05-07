<?php

namespace App\Http\Controllers;
// 33
use App\Models\User;
use Illuminate\Http\Request;
//40
use Illuminate\Auth\Events\Registered;
//44
use Illuminate\Support\Facades\Auth;
//63
use Illuminate\Http\RedirectResponse;
// 79 use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Password;
// 86
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //1
    public function create() {
        return view('users.create'); // будет отвечать за показ формы регистрации
    }

    // 2
    public function store(Request $request) {
        // 27 Самостоятельная реализация аутентификации пользователей
        // https://laravel.su/docs/11.x/authentication
        // https://laravel.su/docs/11.x/validation
        $request->validate([
            'name' => ['required','max:255'],
            'email' => ['required','email','max:255','unique:users'],
            'password' => ['required','confirmed'],
        ]);
        // 28 проеряем

       //34 создаем пользователя, этот объект сохраняем в переменную, она нам еще понадобится
       $user = User::create($request->all());

       //41 создаем событие что пользователь зарегистрирован
       // 42 в web.php
        event(new Registered($user));
        //45 чтобы юзер был auth 46 web.php
        Auth::login($user);


        //2
    //    dd($request->all()); // Функция dd (Dump and Die) выводит данные на экран и вызывает die, блокируя дальнейшее выполнение кода
       // Функция dump также выводит данные на экран, но не блокирет дальнейшее выполнение кода


    //    35 вместо 2
    // return redirect()->route('login');
    // 36 
    // return redirect()->route('login')->with('success', 'Successfully registration');
    //52 вместо 36
    return redirect()->route('verification.notice');
   //53 проверка в storage->logs->log потому что это указано в env
    }

    //3
    public function login() {
        return view('users.login'); // будет отвечать за показ формы входа
    }

    // 48
    public function dashboard()
    {
        return view('users.dashboard');
    }
    // 49 создаем вид дашборда

    // 56 описание 57 добавим route в дашборд main blade
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

// 64  65 - web php
public function loginAuth(Request $request)
    {
        // 68 validate
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required',],
            ]);

            // 69 пока без ,$request->boolean('remember')
            // 71 + remember 72 сброс пароля, модель
        if (Auth::attempt($credentials,$request->boolean('remember') )) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Welcome, ' . Auth::user()->name . '!');
        }

        // 70 проверить
        return back()->withErrors([
            'email' => 'Wrong login or password',
        ]);
        //67 dump
        // dump($request->boolean('remember'));
        // dd($request->all()); 

    }

//     //80 81 - web
    public function forgotPasswordStore(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

//     // 87 88 web.php
    public function resetPasswordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );


        return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('success', __($status))
        : back()->withErrors(['email' => [__($status)]]);

    }
    //4 routes - web.php
    // 29 в main.blade
    // 37 вывод поздравления в main.blade
    // 54 web.php 

            // $status = Password::reset(
        //     $request->only('email', 'password', 'password_confirmation', 'token'),
        //     function (User $user, string $password) {
        //         $user->forceFill([
        //             'password' => $password
        //         ])->setRememberToken(Str::random(60));

        //         $user->save();

        //         event(new PasswordReset($user));
        //     }
        // );
}
