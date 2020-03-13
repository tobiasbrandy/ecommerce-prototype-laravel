@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="pull-right">
        @foreach($subCategories as $category)
          <p><a href="/subSearch/{{$category->id}}/{{$idCategory}}/{{$age}}/{{$price}}">{{$category->name}}</a></p>
        @endforeach
        <p><a href="/search/{{$idCategory}}/{{$age}}/{{$price}}">Todos</a></p>
      </div>
      <div class="col-md-10">
      @if(!$products->isEmpty())
        @foreach($products as $product)
            <div class="col-xs-6 col-sm-3" id="div-{{$product->id}}">
              <div class="thumbnail">
                <img src="/images/product/avatar/{{$product->productAvatar}}" />
                <div class="caption">
                  <h4 style="height: 40px"><a href="/viewProduct/{{$product->id}}" >{{$product->title}}</a></h4>
                  <div>$ {{$product->price}}</div>
                  <div>{{$product->category->name}}</div>
                  <div>{{$product->condition}}</div>
                  <div>Stock: {{$product->stock}}</div>
                  <div>Usuario: <a href="/viewUser/{{$product->user->id}}">{{$product->user->name}}</a> </div>
                  <br>
                  @if(Auth::check() && Auth::user() != $product->user && $product->stock > 0)
                    {{--WISHLIST--}}
                    <div><a class="btn btn-warning" onclick="wishlist({{$product->id}})" id="btn-1-{{$product->id}}"
                      @if(Auth::user()->wishProducts()->get()->contains($product)) style="display:none" @endif >Wishlist</a></div>{{--Flow controller to decide if display should be inline or none,--}}
                                                                                                                                   {{--which depends on the user having the product on wishlist or not.--}}
                    <div><a class="btn btn-danger" onclick="unwishlist({{$product->id}})" id="btn-2-{{$product->id}}"
                      @if(!(Auth::user()->wishProducts()->get()->contains($product))) style="display:none" @endif  >Des-Wishlist</a></div>
                    <br>
                      {{--SHOPLIST--}}
                    <div><a class="btn btn-primary" onclick="shoplist({{$product->id}}); updateShoplistCounter('plus')" id="btn-shp1-{{$product->id}}"
                      @if(Auth::user()->shopProducts()->get()->contains($product)) style="display:none" @endif>Agregar a Carrito</a></div>{{--Flow controller to decide if display should be inline or none,--}}
                                                                                                                                          {{--which depends on the user having the product on shoplist or not.--}}
                    <div><a class="btn btn-danger" onclick="unshoplist({{$product->id}}); updateShoplistCounter('minus')" id="btn-shp2-{{$product->id}}"
                      @if(!(Auth::user()->shopProducts()->get()->contains($product))) style="display:none" @endif>Eliminar de Carrito</a></div>

                  @endif
                  @if(Auth::user() == $product->user)
                    <div><a class="btn btn-success" href="/editProduct/{{$product->id}}">Editar Producto</a></div>
                    <br>
                    <div><a class="btn btn-danger" onclick="deleteProduct({{$product->id}})">Eliminar Producto</a></div>
                  @endif
                </div>
              </div>
            </div>
        @endforeach
      @else
        <div class="alert alert-warning" role="alert">
          No existen Productos con esas especificaciones. <a href="/home">Intenta de nuevo!</a>
        </div>
      @endif
      </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/wishlist.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/shoplist.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/deleteProduct.js') }}"></script>
@endsection
