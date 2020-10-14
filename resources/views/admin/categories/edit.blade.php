@extends('layouts.app')

@section('content')
<div class="mt-5">

    <form class="form-group" method="POST" action="{{ route('admin.categories.update', ['category' => $category->id]) }}">

        @csrf
        @method('PUT')

        <div class="form-group">

            <label>Nome da categoria</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}">


            @error('name')
            <small class="form-text text-danger">
                {{ $message }}
            </small>
            @enderror

        </div>

        <div class="form-group">

            <label>Descricao</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{$category->description}}">

            @error('description')
            <small class="form-text text-danger">
                {{ $message }}
            </small>
            @enderror

        </div>


        <div  class="form-group">

            <label>Slug</label>
            <input type="text" class="form-control" value="{{ $category->slug }}" readonly="">

        </div>




        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Salvar categoria" />
        </div>


    </form>



</div>
@endsection