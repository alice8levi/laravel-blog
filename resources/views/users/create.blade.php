@extends('layouts/main')

@section ('title', 'Home page')

@section('content')

  <div class="row">
    <div class="col-md-6 offset-md-3">
    <h1>Register form</h1>
      <form action="{{route('users.store')}}" method="post">    
       @csrf             
  <div class="form-group">
      <label for="name">Name</label>
    
      <input name = "name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Enter name" value="{{old('name')}}">
      <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else2.</small>
      
      @error('name')
        <div class='invalid-feedback'>{{$message}}</div>
      @enderror
    </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input name = "email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" id="email" aria-describedby="emailHelp" placeholder="Enter email" >
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    @error('email')
        <div class='invalid-feedback'>{{$message}}</div>
    @enderror
  </div>
  
  <div class="form-group">
    <label for="password">Password</label>
    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
    @error('password')
        <div class='invalid-feedback'>{{$message}}</div>
      @enderror
  </div>
  <!-- https://laravel.su/docs/11.x/validation подтверждение пароля -->
  <div class="form-group">
    <label for="password_confirmation">Confirm Password</label>
    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password">
  </div>

  <button type="submit" class="btn btn-primary">Register</button>
  
   <a href="{{route('login')}}" class="ms-3">Already registered?</a>
</form>
</div>
  </div>
@endsection
