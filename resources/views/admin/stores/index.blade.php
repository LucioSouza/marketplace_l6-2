@extends('layouts.app')

@section('content')
<div>

    @if($store)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Loja</th>
                <th>Total produtos</th>
                <th>Dono</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $store->id }}</td>
                <td>{{ $store->name }}</td>
                <td>{{ $store->products->count() }}</td>
                <td>{{ $store->user->name }}</td>
                
                <td>
                    <a href="{{ route('admin.stores.edit', ['store' => $store->id]) }}" class="btn btn-primary float-left mr-2 mb-sm-2">Editar</a>


                    <form action="{{ route('admin.stores.destroy', ['store' => $store->id]) }}" method="POST">

                        @csrf
                        @method('DELETE')


                        <button type="submit" class="btn btn-danger">Excluir</button>

                    </form>


                </td>
            </tr>
        </tbody>
    </table>

    @else

    <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">Olá {{ auth()->user()->name }}!</h4>
        <p>Você não tem nenhuma Loja criada no momento</p>
        <hr>
        <p class="mb-0">Aproveite agora para <a href="{{ route('admin.stores.create') }}" class="alert-link badge badge-pill bg-primary text-white py-2">Criar loja</a></p>
    </div>

    @endif
</div>


@endsection

