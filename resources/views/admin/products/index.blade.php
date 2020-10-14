@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.products.create') }}" class="btn btn-dark mb-3">Criar produto</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Loja</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>R$ {{ number_format($product->price, 2) }}</td>
                <td>{{ $product->store->name }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-primary float-left mr-3 mb-sm-2">Editar</a>

                    <!-- 
                    
                        O form é criado aqui para que o laravel permita a exclusão do produto em questão, pois o laravel espera um verbo HTTP DELETE
                    
                        Fazemos dessa forma, pois não posso simplesmente criar um <a href="{{ route('admin.products.destroy', ['product' => $product->id]) }}"></a>, 
                    
                        Pois ao clicar no link acima, a ação acaba caindo no método show() no controller e não no método destroy().
                    
                        Para resolver isso fazemos um POST para o método desejado
                    
                    -->
                    <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Excluir</button>

                    </form>



                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    {!! $products->appends(Request::all())->links() !!}

</div>




@endsection

