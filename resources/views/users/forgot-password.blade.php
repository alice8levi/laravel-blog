@extends('layouts.main')

@section('title', 'Home page')

@section('content')
    <h1 class="h2">Forgot password</h1>

    <p>Input your email to get a link for password change.</p>

    <form action="{{ route('password.email') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email"  class="form-control @error('email') is-invalid @enderror"
                id="email" placeholder="Email"  value="{{ old('email') }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Send</button>

    </form>

@endsection