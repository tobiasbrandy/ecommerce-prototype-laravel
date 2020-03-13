@extends('layouts.app')

@section('content')
<div class="container">
  <div class="pull-left" style="width: 50%">
    <img src="/images/product/avatar/{{$product->productAvatar}}" class="img-responsive" />
  </div>
  <div class="pull-left" style="width: 50%">
    <h2 class="text-center" style="line-height: 1.6">{{$product->title}}</h2>
    <h4 class="text-center" style="line-height: 1.6">Precio: ${{$product->price}}</h4>
    <h4 class="text-center" style="line-height: 1.6">Condición: {{$product->condition}}</h4>
    <h4 class="text-center" style="line-height: 1.6">Stock: {{$product->stock}}</h4>
    <h4 class="text-center" style="line-height: 1.6"><i class="glyphicon glyphicon-heart"></i> : {{$product->wishUsers()->count()}}</h4>
    <h4 class="text-center" style="line-height: 1.6">Categoría: {{$product->category->parentCategory->name}}</h4>
    <h4 class="text-center" style="line-height: 1.6">Sub Categoría: {{$product->category->name}}</h4>
    <h4 class="text-center" style="line-height: 1.6">Usuario: <a href="/viewUser/{{$product->user->id}}">{{$product->user->name}}</a></h4>
    <h4 class="text-center" style="line-height: 1.6">Descripción: {{$product->description}}</h4>
  </div>
</div>
@endsection
