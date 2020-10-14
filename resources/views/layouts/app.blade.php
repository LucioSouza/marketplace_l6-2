<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <title>Hello, world!</title>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
            <a class="navbar-brand" href="{{ route('home') }}">Laravel</a>


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">



                @auth
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if(request()->is('admin/orders*')) active @endif">
                        <a class="nav-link" href="{{ route('admin.orders.my') }}">Pedidos <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                        <a class="nav-link" href="{{ route('admin.stores.index') }}">Lojas</a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                        <a class="nav-link" href="{{ route('admin.products.index')}}">Produtos</a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                        <a class="nav-link" href="{{ route('admin.categories.index')}}">Categorias</a>
                    </li>
                </ul>


                <div class="my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">



                        <li class="nav-item @if(request()->is('admin/notifications*')) active @endif">
                            <a class="nav-link" href="{{ route('admin.notifications.index')}}">
                                <i class="fa fa-bell"></i>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="badge badge-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                                @endif
                            </a>
                        </li>


                        <li class="nav-item">

                            <a class="nav-link"><span>{{ auth()->user()->name }}</span></a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault();document.querySelector('form.logout').submit()">Sair</a>

                            <form action="{{ route('logout') }}" class="logout d-none" method="POST">

                                @csrf

                            </form>
                        </li>
                    </ul>
                </div>
                @endauth


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