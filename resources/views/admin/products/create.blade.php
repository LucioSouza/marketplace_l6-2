@extends('layouts.app')

@section('content')
<div class="mt-5">

    <form class="form-group" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">

        @csrf

        <div class="form-group">

            <label>Nome produto</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}">

            @error('name')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror

        </div>

        <div class="form-group">

            <label>Descricao</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description')}}">

            @error('description')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror

        </div>

        <div class="form-group">

            <label>Conteúdo</label>
            <textarea class="form-control @error('body') is-invalid @enderror" name="body">{{ old('body')}}</textarea>

            @error('body')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror

        </div>

        <div  class="form-group">

            <label>Preço</label>
            <input type="text" class="form-control money2 @error('price') is-invalid @enderror" name="price" value="{{ old('price')}}">

            @error('price')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror

        </div>


        <div class="form-group">
            <label>Fotos do Produto</label>
            <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>

            @error('photos.*')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>


        <div  class="form-group">

            <label>Categorias</label>
            <select  class="form-control @error('categories') is-invalid @enderror" name="categories[]" id="categories" multiple="">

                @foreach($categories as $category)

                <option value="{{ $category->id }}">{{ $category->name }}</option>

                @endforeach

            </select>

            @error('categories')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror

        </div>


        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Criar produto" />
        </div>


    </form>



</div>
@endsection


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>

<script>

$(function () {
    $('.money2').mask('#,##0.00', {reverse: true});
});


</script>


@endsection