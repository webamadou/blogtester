@extends('layouts.app')

@section('content')
    <div class="container">
        {{Auth::user()->email}}
        @if(session('success'))
            <div class="row"><div class="col-12"><div class="alert alert-success">{{session('success')}}</div></div></div>
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="row"><div class="alert alert-danger">{{$error}}</div></div>
            @endforeach
        @endif
        <form action="{{route('store_product')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-4">Nom du produit</div>
                <div class="col-8"><input type="text" name="name" id="name" class="form-control" autocomplete="off" ></div>
            </div>
            <div class="row">
                <div class="col-4">Prix du produit</div>
                <div class="col-8"><input type="text" name="price" id="price" class="form-control" autocomplete="off" ></div>
            </div>
            <div class="row">
                <div class="col-4">Image</div>
                <div class="col-8"><input type="file" name="image" id="image" class="form-control" autocomplete="off" ></div>
            </div>
            <div class="row">
                <div class="col-12"><button class="btn btn-primary">Valider</button></div>
            </div>
        </form>
    </div>
@endsection