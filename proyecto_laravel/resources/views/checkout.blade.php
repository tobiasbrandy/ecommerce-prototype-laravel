@extends('layouts.app')

@section('content')
<div class="container">
  @if(!$products->isEmpty())
    <form  id="form" action="/api/mercadopago/createPreference" method="get">
      <div class="pull-right">
        <div>Total a Pagar: <span id="totalPrice" >{{$totalPrice}}</span></div>
        <br>
        <div><a class="btn btn-primary" onclick="document.querySelector('#form').submit()" >Checkout</a></div>
      </div>
      <div class="col-md-10">
        <div id="product-full">
          @foreach($products as $product)
            @if($product->stock > 0)
              <div class="col-xs-6 col-sm-3" id="div-{{$product->id}}" >
                <div class="thumbnail">
                  <img src="/images/product/avatar/{{$product->productAvatar}}" />
                  <div class="caption">
                    <h4 style="height: 40px" ><a href="viewProduct/{{$product->id}}" >{{$product->title}}</a></h4>
                    <div>$ <span id="productPrice">{{$product->price}}</span></div>
                    <div>{{$product->category->name}}</div>
                    <div>{{$product->condition}}</div>
                    <div>Usuario: <a href="/viewUser/{{$product->user->id}}">{{$product->user->name}}</a> </div>
                    <div>Cantidad:
                      <select name="quantity{{$product->id}}" id="quantity" onchange="updateTotalPrice()">
                        @for($i=1; $i <= $product->stock ; $i++)
                          <option value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
                    </div>
                    <br>
                    @if(Auth::check())
                      <div><a class="btn btn-danger" onclick="unshoplistAndUnlist({{$product->id}}); updateShoplistCounter('minus')" id="btn-shp2-{{$product->id}}">Eliminar de Carrito</a></div>
                    @endif
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </form>
  @endif
  <div class="col-md-10">
    <div class="alert alert-warning" role="alert" id="product-empty" @if(!$products->isEmpty()) style="display:none" @endif >
      No tienes productos en tu Carrito de Compras en este momento. <a href="/home">Busca alguno ya!</a>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/shoplist.js') }}"></script>
@endsection
