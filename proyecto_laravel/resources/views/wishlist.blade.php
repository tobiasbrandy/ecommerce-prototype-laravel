@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="col-md-10">
      @if(!$products->isEmpty())
        <div id="product-full">
          @foreach($products as $product)
            <div class="col-xs-6 col-sm-3" id="div-{{$product->id}}" >
              <div class="thumbnail">
                <img src="/images/product/avatar/{{$product->productAvatar}}" />
                <div class="caption">
                  <h4 style="height: 40px"><a href="viewProduct/{{$product->id}}" >{{$product->title}}</a></h4>
                  <div>$ {{$product->price}}</div>
                  <div>{{$product->category->name}}</div>
                  <div>{{$product->condition}}</div>
                  <div>Stock: {{$product->stock}}</div>
                  <div>Usuario: <a href="/viewUser/{{$product->user->id}}">{{$product->user->name}}</a> </div>
                  <br>
                  @if(Auth::check())
                    <div><a class="btn btn-danger" onclick="unwishlistAndUnlist({{$product->id}})" id="btn-2-{{$product->id}}" >Des-Wishlist</a></div>
                  @endif
                  <br>
                  <div><a class="btn btn-primary" onclick="shoplist({{$product->id}}); updateShoplistCounter('plus')" id="btn-shp1-{{$product->id}}"
                    @if(Auth::user()->shopProducts()->get()->contains($product)) style="display:none" @endif>Agregar a Carrito</a></div>{{--Flow controller to decide if display should be inline or none,--}}
                                                                                                                                        {{--which depends on the user having the product on shoplist or not.--}}
                  <div><a class="btn btn-danger" onclick="unshoplist({{$product->id}}); updateShoplistCounter('minus')" id="btn-shp2-{{$product->id}}"
                    @if(!(Auth::user()->shopProducts()->get()->contains($product))) style="display:none" @endif>Eliminar de Carrito</a></div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        @endif
          <div class="alert alert-warning" role="alert" id="product-empty" @if(!$products->isEmpty()) style="display:none" @endif >
            No tienes productos en tu Lista de Deseos en este momento. <a href="/home">Busca alguno ya!</a>
          </div>
      </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/wishlist.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/shoplist.js') }}"></script>
@endsection
