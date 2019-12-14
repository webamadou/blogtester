@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="row"><div class="col-12"><div class="alert alert-success">{{session('success')}}</div></div></div>
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                    <div class="row"><div class="col-12"><div class="alert alert-danger">{{$error}}</div></div></div>
            @endforeach
        @endif
        <form action="{{route('edit_product',['id'=>$product->id])}}" method="post">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-4">Nom du produit</div>
                <div class="col-8">
                    <input type="text" name="name" id="name" class="form-control" autocomplete="off" value="{{$product->name}}">
                </div>
            </div>
            <div class="row">
                <div class="col-4">Prix du produit</div>
                <div class="col-8"><input type="text" name="price" id="price" class="form-control" autocomplete="off" value="{{$product->price}}"></div>
            </div>
            <div class="row">
                <div class="col-4">La catégorie</div>
                <div class="col-8">
                    <select name="category_id" id="category_id" class="form-control">
                        <option value=""> --- </option>
                        @foreach($categories as $key => $value)
                            <option value="{{$key}}" {{$key == $product->category_id ? 'selected="selected"': ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12"><button class="btn btn-primary">Valider</button></div>
            </div>
        </form>
    </div>
@endsection