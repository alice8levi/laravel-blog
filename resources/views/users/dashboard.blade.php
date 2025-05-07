<!-- //48 -->
@extends('layouts.main')

@section('title', 'Home page')
<!-- 58    59 env  и почта -->
@section('content')
    <h1 class="h2">Dashboard page</h1>
    <h3 class="h3">Welcome, {{ auth()->user()->name }}!</h3>
    <a href="{{route('logout')}}">Logout</a>
@endsection
<!-- 49 web.php -->