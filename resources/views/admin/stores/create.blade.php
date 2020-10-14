@extends('layouts.app')

@section('content')
<div class="mt-5">

    <form class="form-group" method="POST" action="{{ route('admin.stores.store') }}" enctype="multipart/form-data">

        @csrf

        <div class="form-group">

            <label>Nome loja</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">


            @error('name')
            <small class="form-text text-danger">
                {{ $message }}
            </small>
            @enderror

        </div>

        <div class="form-group">

            <label>Descricao</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{old('description')}}">

            @error('description')
            <small class="form-text text-danger">
                {{ $message }}
            </small>
            @enderror

        </div>

        <div  class="form-group">

            <label>Telefone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone')}}">

            @error('phone')
            <small class="form-text text-danger">
                {{ $message }}
            </small>
            @enderror

        </div>

        <div  class="form-group">

            <label>Celular</label>
            <input type="text" class="form-control @error('mobile_phone') is-invalid @enderror" name="mobile_phone" value="{{old('mobile_phone')}}">

            @error('mobile_phone')
            <small class="form-text text-danger">
                {{ $message }}
            </small>
            @enderror

        </div>


        <div class="form-group">
            <label>Logo da loja</label>
            <input type="file" class="form-control-file @error('logo') is-invalid @enderror" name="logo">

            @error('logo')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror

        </div>


        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Criar loja" />
        </div>


    </form>



</div>
@endsection