@extends('layouts.front')


@section('content')

<div class="container">


    <div class="row">

        <div class="col-md-12">



            @if(!empty($cart))

            <h2>Carrinho de compras</h2>

            <table class="table table-borderless table-striped">

                <thead>

                    <tr>

                        <th>Produto</th>
                        <th>Preço</th>
                        <th class="text-center">Quantidade</th>
                        <th>Subtotal</th>
                        <th class="text-center">Remover</th>

                    </tr>

                </thead>

                <tbody>

                    @php


                    $total = 0;

                    @endphp

                    @foreach($cart as $item)

                    <tr>

                        <td>{{ $item['name'] }}</td>
                        <td>R${{ number_format($item['price'], 2) }}</td>
                        <td class="text-center">{{ $item['amount'] }}</td>

                        @php 

                        $subtotal = $item['price'] * $item['amount'];

                        $total += $subtotal;

                        @endphp


                        <td>R${{ number_format($subtotal, 2) }}</td>
                        <td class="text-center">
                            <a href="{{ route('cart.remove', ['slug' => $item['slug']]) }}" class="btn btn-sm btn-danger py-0">X</a>
                        </td>

                    </tr>


                    @endforeach

                    <tr>
                        <td class="text-right font-weight-bold" colspan="3">Total:</td>
                        <td colspan="3">R${{ number_format($total, 2) }}</td>
                    </tr>



                </tbody>

            </table>


            <div class="row">

                <div class="col-md-12">

                    <a href="{{ route('checkout.index')}}" class="btn btn-primary float-right">Concluir compra</a>
                    <a href="{{ route('cart.cancel') }}" class="btn btn-secondary float-left">Cancelar compra</a>


                </div>


            </div>


            @else

            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Seu carrinho está vazio</h4>
                <hr>
                <p class="mb-0">Aproveite agora para <a href="{{ route('home') }}" class="alert-link badge badge-pill bg-primary text-white py-2">comprar</a></p>
            </div>

            @endif


        </div>




    </div>



</div>



@endsection