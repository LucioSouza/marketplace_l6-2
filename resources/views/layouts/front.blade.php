<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Marketplace L6</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            .front.row {
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">

            <a class="navbar-brand" href="{{route('home')}}">Marketplace L6</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if(request()->is('/')) active @endif">
                        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>

                    @foreach($categories as $category)


                    <li class="nav-item @if(request()->is('category/'.$category->slug)) active @endif">
                        <a class="nav-link" href="{{ route('category.single', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                    </li>

                    @endforeach


                </ul>

                @auth

                <div class="my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault();document.querySelector('form.logout').submit()">Sair</a>

                            <form action="{{ route('logout') }}" class="logout d-none" method="POST">

                                @csrf

                            </form>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{auth()->user()->name}}</span>
                        </li>
                    </ul>
                </div>
                @endauth

                <div class="my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('user.orders')}}">
                                Meus pedidos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('cart.index')}}">
                                Carrinho
                                @if(session()->has('cart'))

                                <span class="badge badge-info">{{ count(session()->get('cart')) }}</span>

                                @endif
                            </a>
                        </li>
                    </ul>
                </div>



            </div>
        </nav>

        <div class="container">
            @include('flash::message')
            @yield('content')
        </div>


        <!-- 
             Jquery e o popper.js já vem no app.js quando é gerado build.
             Pode ser verificado em: resouce/js/bootstrap.js
        -->
        <script src="{{ asset('js/app.js') }}"></script>


        <!-- 
            Serve para carregarmos os scripts que cada view terá dentro de uma @section('scripts')
        -->
        @yield('scripts')
        
        
    </body>
</html>