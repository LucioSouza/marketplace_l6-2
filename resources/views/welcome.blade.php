@extends('layouts.front')


@section('content')


<div class="container">

    <h1>Produtos</h1>

    <!--{{ $categories }}-->

    <ul class="list-inline text-center">
        @foreach($products as $product)

        <li class="list-inline-item mb-4">

            <div class="card" style="width: 16rem;">

                {{-- Só exibimos a imagem do produto que a tiver --}}
                @if($product->photos->count())

                <img style="height: 200px" class="card-img-top" src="{{ asset('storage/'.$product->thumb) }}" alt="Card image cap">

                @else

                {{-- Caso contrário, exibimos uma imagem default --}}
                <img style="height: 200px" class="card-img-top" src="{{ asset('assets/img/no-photo.jpg') }}" alt="Card image cap">

                @endif

                <div class="card-body">

                    @if($product->categories->count())
                    <small class="text-info">{{ $product->categories->first()->name }}</small>
                    @endif
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <h6 style="font-size: 22px">R${{ number_format($product->price, 2) }}</h6>
                    <p class="card-text">{{ Str::words($product->description, 6)}}</p>
                    <a href="{{ route('product.single', ['slug' => $product->slug])}}" class="btn btn-primary">Detalhes</a>
                </div>
            </div>

        </li>

        @endforeach
    </ul>
</div>

<div class="container">

    <h1>Lojas destaques</h1>

    <ul class="list-inline text-center">
        @foreach($stores as $store)

        <li class="list-inline-item mb-4">

            <div class="card" style="width: 16rem;">

                {{-- Só exibimos a imagem da loja que a tiver --}}
                @if($store->logo)

                <img style="height: 200px" class="card-img-top" src="{{ asset('storage/'.$store->logo) }}" alt="Card image cap">

                @else

                {{-- Caso contrário, exibimos uma imagem default --}}
                <img style="height: 200px" class="card-img-top" src="https://via.placeholder.com/250x200.png?text=logo" alt="Card image cap">

                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $store->name }}</h5>
                    <p class="card-text">{{ Str::words($store->description, 6)}}</p>
                    <a href="{{ route('store.single', ['slug' => $store->slug]) }}" class="btn btn-success btn-sm">Ver loja</a>
                </div>
            </div>

        </li>

        @endforeach
    </ul>
</div>












@endsection