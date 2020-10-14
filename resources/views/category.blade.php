@extends('layouts.front')


@section('content')


<div class="container">

   
    <ul class="list-inline text-center">

        {{-- 
            
            Exibindo todos os produtos de acordo com a categoria selecionada pela navbar 
            
            Não esquecer que a a relação de categoria e produtos se dá no Model Category através do método 'public function products()'
            
            --}}

        @if($category->products->count())
        
        <h1 class="text-left">{{ $category->name }}</h1>

        @foreach($category->products as $product)

        <li class="list-inline-item mb-4">

            <div class="card" style="width: 16rem;">

                {{-- Só exibimos a imagem do produto que a tiver --}}
                @if($product->photos->count())

                <img style="height: 200px" class="card-img-top" src="{{ asset('storage/'.$product->photos->first()->image) }}" alt="Card image cap">

                @else

                {{-- Caso contrário, exibimos uma imagem default --}}
                <img style="height: 200px" class="card-img-top" src="{{ asset('assets/img/no-photo.jpg') }}" alt="Card image cap">

                @endif

                <div class="card-body">
                    <small class="text-info">{{ $product->categories->first()->name }}</small>
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <h6 style="font-size: 22px">R${{ number_format($product->price, 2) }}</h6>
                    <p class="card-text">{{ Str::words($product->description, 6)}}</p>
                    <a href="{{ route('product.single', ['slug' => $product->slug])}}" class="btn btn-primary">Detalhes</a>
                </div>
            </div>

        </li>

        @endforeach

        @else

        <h5>Não existem produtos com a categoria {{ $category->name }}</h5>

        @endif

    </ul>
</div>

@endsection