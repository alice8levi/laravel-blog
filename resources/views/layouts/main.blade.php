<!--11 создать шаблон и подключить бутстрап -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 12 yield создание секции -->
     <!-- https://qna.habr.com/q/444608 -->
    <title>@yield('title', 'laravel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>    
    <div class="wrapper">        
      <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light"> 
          <div class="container-fluid container">       
            <a class="navbar-brand" href="{{route('home')}}"><b>B</b></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>     
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('posts.index')}}">Recent</a> 
                </li>

                @if (Route::has('login'))
                    @auth
                    <li class="nav-item">                  
                      <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a> 
                     </li>
                     <li>
                       <a class="nav-link" href="{{route('posts.create')}}">Create Post</a>
                     </li>
                    @else

                    <li class="nav-item">
                      <a class="nav-link" href="{{route('login')}}">Login</a> 
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('register')}}">Register</a> 
                    </li>
                    @endif
                @endif
                <!-- 18 в welcome.blade -->
              
              </ul>
            </div>
          </div>
        </nav>
    </header>
   </div>
    <!-- 13 -->
     <!-- <main class = "main mt-3">
        <div class="container">
            собакаyield('content')
        </div> -->
         <!-- 29 добавление обработки ошибок -->
     <!-- https://laravel.su/docs/11.x/validation -->
      <main class = "main mt-3">
        <div class="container">

          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
           
          <!-- 37 ?Successfully reg -->
          @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
            @yield('content')
        </div>

     </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>