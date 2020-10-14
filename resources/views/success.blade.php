@extends('layouts.front')


@section('content')

<div class="container mx-auto">


    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Muito obrigado, {{ auth()->user()->name }}!</h4>
        <p>Seu pedido <span class="text-dark font-weight-bold">{{ request()->get('order') }}</span> foi realizado com sucesso! </p>
        <hr>
        <p class="mb-0">Você será notificado em cada evento do seu pedido, beleza?</p>
    </div>


</div>


@endsection
