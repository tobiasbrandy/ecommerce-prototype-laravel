@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="col-md-10">
      @if(!$products->isEmpty())
        <div id="product-full">
          @foreach($products as $product)
            <div class="col-xs-6 col-sm-3" id="div-{{$product->id}}">
              <div class="thumbnail">
                <img src="/images/product/avatar/{{$product->productAvatar}}" />
                <div class="caption">
                  <h3 style="height: 40px"><a href="viewProduct/{{$product->id}}" >{{$product->title}}</a></h3>
                  <div>$ {{$product->price}}</div>
                  <div>{{$product->category->parentCategory->name}}</div>
                  <div>{{$product->category->name}}</div>
                  <div>{{$product->condition}}</div>
                  <div>Stock: {{$product->stock}}</div>
                  <div><a class="btn btn-success" href="/editProduct/{{$product->id}}">Editar Producto</a></div>
                  <br>
                  <div><a class="btn btn-danger" onclick="deleteProduct({{$product->id}})">Eliminar Producto</a></div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
        <div class="alert alert-warning" role="alert" id="product-empty" @if(!$products->isEmpty()) style="display:none" @endif>
          Todavia no has creado ningun producto! <a href="/registerProduct">Crea un producto ahora.</a>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/deleteProduct.js') }}"></script>
@endsection
