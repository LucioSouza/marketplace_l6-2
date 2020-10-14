@extends('layouts.front')

@section('content')

<div class="row">

    <div class="col-md-12">




        <div id="accordion">

            <h2>Meus pedidos</h2>

            @forelse($userOrders as $key => $order)

            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapseOne">
                            Pedido: {{ $order->reference }}
                        </button>
                    </h5>
                </div>

                <div id="collapse{{ $key }}" class="collapse @if($key == 0) show @endif " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">

                        @php 

                        $items = unserialize($order->items)  

                        @endphp


                        <ul>

                            <!-- 
                                Aqui não preciso utiliza a função filterItemsByStoreId,
                                pois todos os items pertencem ao usuário logado
                            -->
                            
                            @foreach($items as $item)


                            <li>
                                {{ $item['name'] }}| R${{ number_format($item['price'] * $item['amount'], 2) }}<br>
                                Quantidade: {{ $item['amount'] }}
                            </li>


                            @endforeach


                        </ul>




                    </div>
                </div>
            </div>

            @empty

            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Informação!</h4>
                <p>Você não realizou nenhum pedido</p>
                <hr>
            </div>


            @endforelse

        </div>


    </div>

</div>


@endsection

