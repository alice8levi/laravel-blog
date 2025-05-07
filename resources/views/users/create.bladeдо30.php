<!-- //8 BLADE - шаблонизатор-->
<!-- Register form -->

<!-- 19 -->
@extends('layouts/main')

@section ('title', 'Home page')

@section('content')
<!-- <h1>Register form</h1> -->
 <!-- 21 name должно повторять поле в таблице БД-->
  <div class="row">
    <div class="col-md-6 offset-md-3">
    <h1>Register form</h1>
    <!-- <form action=""> -->
      <!-- 23 заполнить экшн -->
      <form action="{{route('users.store')}}" method="post">    
        <!-- 25 токен  -->
         @csrf

  <div class="form-group">
    <label for="email">Email address</label>
    <input name = "email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="name">Name</label>
    <input name = "name" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter name">
    <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else2.</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
  </div>
  <!-- https://laravel.su/docs/11.x/validation подтверждение пароля -->
  <div class="form-group">
    <label for="password_confirmation">Confirm Password</label>
    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password">
  </div>
  <!-- <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary">Register</button>
  <!-- 22 если удже зарег -->
   <a href="{{route('login')}}" class="ms-3">Already registered?</a>
</form>
</div>
  </div>
@endsection
<!-- 24 запускаем, получа 419 нужно скрытое поле с токеном -->
 <!-- 26 запускаем, маршрут отработал -->
  <!-- 27 в user controller -->
