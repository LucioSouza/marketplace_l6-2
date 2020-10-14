@extends('layouts.front')


@section('content')


<div class="container">

    <div class="row">

        <div class="col-md-4 offset-1">

            {{-- Só exibimos a imagem do produto que a tiver --}}
            @if($product->photos->count())

            <img style="height: 180px" class="card-img-top" src="{{ asset('storage/'.$product->thumb) }}" alt="Card image cap">

            @else

            {{-- Caso contrário, exibimos uma imagem default --}}
            <img style="height: 180px" class="card-img-top" src="{{ asset('assets/img/no-photo.jpg') }}" alt="Card image cap">

            @endif

            <div class="row">

                @foreach($product->photos as $photo)
                <div class="col-3">

                    <img class="img-fluid" src="{{ asset('storage/'.$photo->image) }}" alt="{{ $product->name }}">

                </div>
                @endforeach


            </div>


        </div>

        <div class="col-sm-6">

            <div class="card border-0">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">R${{ number_format($product->price, 2) }}</h6>
                    <a href="{{ route('store.single', ['slug' => $product->store->slug]) }}" class="card-link">Loja {{ $product->store->name }}</a>

                    <hr>


                    <div class="product-add mt-3">

                        <form action="{{ route('cart.add') }}" method="post">

                            @csrf

                            <input type="hidden" name="product[name]" value="{{ $product->name }}">
                            <input type="hidden" name="product[price]" value="{{ $product->price }}">
                            <input type="hidden" name="product[slug]" value="{{ $product->slug }}">


                            <div class="form-group">

                                <label>Quantidade</label>
                                <input type="number" name="product[amount]" class="form-control col-3" value="1" required="">

                            </div>

                            <button type="submit" class="btn btn-success">Adicionar ao carrinho</button>


                        </form>


                    </div>

                </div>

            </div>

        </div>
    </div>


    <div class="row">


        <div class="col-md-12">


            <hr>

            {{ $product->body }}


        </div>

    </div>



</div>



@endsection