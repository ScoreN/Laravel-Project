
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "{{ asset('css/app.css') }}">
    <link rel = "stylesheet" href = "{{ asset('css/style.css') }}">
    <link rel = "stylesheet" href = "{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    @stack('styles')
    <title>Document</title>
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light px-5" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="/">Блог</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <form class="form-inline my-2 my-lg-0" id = "formSearch" method="GET" action="{{ route('search') }}">
                    <input class="form-control mr-sm-2" type="text" name="search" placeholder="Найти блог" aria-label="Search" id="frmCtrl">
                    <button class="btn my-2 px-4 my-sm-0" id="navBtns" type="submit">Найти</button>
                </form>
                <li class="nav-item active mx-5" id = "formCreate">
                    <button type="button" class="btn my-2 px-4 my-sm-0 offset-6" id="navBtns" data-bs-toggle="modal" data-bs-target="#createPost" aria-pressed="false" autocomplete="off">Создать</button>
                </li>
            </ul>

            <div>
                @if (Route::has('login'))
                    <div class="hidden top-0 right-0 px-6 py-1 sm:block">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn my-2 px-4 my-sm-0 text-sm text-gray-700 dark:text-gray-500 underline" id="auth">Профиль</a>
                        @else
                            <a href="{{ route('login') }}" class="btn my-2 px-4 my-sm-0 text-sm text-gray-700 dark:text-gray-500 underline" id="auth">Войти</a>
                            @if (Route::has('register'))                                
                                <a href="{{ route('register') }}" class="btn my-2 px-4 my-sm-0 ml-4 text-sm text-gray-700 dark:text-gray-500 underline" id="auth">Зарегистрироваться</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <div class="interlayer">
    </div>
    
        <div class="container">
            @if($errors->any())
                @foreach($errors->all() as $error)          
                    <div class="alert alert-danger fade-show" id="my-alert" role="alert">
                        {{$error}}
                    </div>
                @endforeach
            @endif
            @if (session('success'))
                <div class="alert alert-success fade-show" id="my-alert" role="alert">
                    {{session('success')}}
                </div>
            @endif
            @yield('content')
        </div> 
 

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(function(){
          window.setTimeout(function(){
            $('#my-alert').alert('close');
          },3000);
        });
      </script>
    @stack('scripts')
</body>
</html>