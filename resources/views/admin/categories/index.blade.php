@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('admin.categories.create') }}" class="btn btn-dark mb-3">Criar categoria</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-primary float-left mr-3 mb-sm-2">Editar</a>

                    <form action="{{ route('admin.categories.destroy', ['category' => $category->id])}}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Excluir</button>

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {!! $categories->appends(Request::all())->links() !!}

</div>




@endsection

