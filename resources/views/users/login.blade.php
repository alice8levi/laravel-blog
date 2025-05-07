<!-- 9 -->
<!-- Login form -->
<!-- 10 создать папку layouts  в ней main.blade.php -->
 

<!-- 20 -->
@extends('layouts.main')

@section('title', 'Home page')

@section('content')
    <h1 class="h2">Login form</h1>
<!-- 62 63контоллер -->
<!-- 66 action 67 user contr -->
    <form action="{{route("login.auth")}}" method="post">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Email">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="password" placeholder="Password">
        </div>

        <div class="mb-3 form-check">
            <input name="remember" class="form-check-input" type="checkbox" id="remember">
            <label class="form-check-label" for="remember">
                Remember me
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>

        <!-- 77 78 создать вид-->
        <a href="{{ route('password.request') }}" class="ms-2">Forgot password?</a>
    </form>

@endsection

<!-- 21 - добавление формы в create -->