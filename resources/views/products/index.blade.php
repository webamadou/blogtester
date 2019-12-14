@extends('layouts.app')

@section('content')
    <div class="container">
        <p><a href="{{route('create_product')}}">Ajouter un produit</a></p>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr><th>Nom des produit</th><th>Prix</th></tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                            <tr>
                                <td>{{$product->name}} <img src="{{asset($product->images)}}" width="100px"></td>
                                <td>{{$product->price}} - <a href="{{route('edit_product',['id'=>$product->id])}}">Editer</a></td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection