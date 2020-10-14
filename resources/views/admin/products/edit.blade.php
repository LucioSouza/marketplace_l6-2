@extends('layouts.app')

@section('content')
<div class="mt-5">

    <form class="form-group" method="POST" action="{{ route('admin.products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">


        @method('PUT')
        @csrf

        <div class="form-group">

            <label>Nome produto</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"" name="name" value="{{ $product->name }}">

            @error('name')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror

        </div>

        <div class="form-group">

            <label>Descricao</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $product->description }}">

            @error('description')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror

        </div>

        <div class="form-group">

            <label>Conteúdo</label>
            <textarea class="form-control @error('body') is-invalid @enderror" name="body">{{ $product->body }}</textarea>

            @error('body')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror

        </div>

        <div  class="form-group">

            <label>Preço</label>
            <input type="text" class="form-control money2 @error('body') is-invalid @enderror" name="price" value="{{ $product->price }}">

            @error('price')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror

        </div>

        <div  class="form-group">

            <label>Categorias</label>
            <select  class="form-control @error('categories') is-invalid @enderror" name="categories[]" id="categories" multiple="">

                @foreach($categories as $category)

                <option value="{{ $category->id }}" @if($product->categories->contains($category)) selected="" @endif >{{ $category->name }}</option>

                @endforeach

            </select>

            @error('categories')
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

            <label>Slug</label>
            <input type="text" class="form-control" value="{{ $product->slug }}" readonly="">

        </div>


        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Atualizar produto" />
        </div>


    </form>

    <hr>


    <div class="form-group row mb-5">

        @foreach($product->photos as $photo)


        <div class="text-center col-1" style="max-width: 100px">


            <img src="{{ asset('storage/' . $photo->image) }}" class="img-fluid">

            <form action="{{ route('admin.photo.remove')}}" method="post">

                @csrf

                <input type="hidden" name="photoName" value="{{ $photo->image }}">

                <button type="submit" class="btn btn-danger">X</button>

            </form>

        </div>

        @endforeach

    </div>



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