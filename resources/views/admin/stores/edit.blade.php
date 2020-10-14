@extends('layouts.app')

@section('content')
<div class="mt-5">

    <form method="POST" action="{{ route('admin.stores.update', ['store' => $store->id]) }}" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <div class="form-group">

            <label>Nome loja</label>
            <input type="text" class="form-control" name="name" value="{{ $store->name }}">

        </div>

        <div class="form-group">

            <label>Descricao</label>
            <input type="text" class="form-control" name="description" value="{{ $store->description }}">

        </div>

        <div class="form-group">

            <label>Telefone</label>
            <input type="text" class="form-control" name="phone" value="{{ $store->phone }}">

        </div>

        <div class="form-group">

            <label>Celular</label>
            <input type="text" class="form-control" name="mobile_phone" value="{{ $store->mobile_phone }}" >

        </div>


        <div class="form-group">
            <label>Logo da loja</label>
            <input type="file" class="form-control-file @error('logo') is-invalid @enderror" name="logo">

            @error('logo')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror

            <div class="mt-3">

                <img style="max-width: 100px" class="img-fluid" src="{{ asset ('storage/'.$store->logo) }}"/>

            </div>

        </div>


        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Atualizar loja" />
        </div>


    </form>



</div>
@endsection