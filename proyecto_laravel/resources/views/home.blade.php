@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">Buscador</div>
                <div class="panel-body">
                  Buscá el regalo perfecto
                  <form class="form-horizontal" role="form" method="POST" action="{{ url('/search') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                        <label for="category" class="col-md-4 control-label">Categorías</label>

                        <div class="col-md-6">
                            <select class="form-control" name="category">
                              @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                            </select>

                            @if ($errors->has('category'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price" class="col-md-4 control-label">Precio Máximo</label>

                        <div class="col-md-6">
                            <input id="price" type="text" class="form-control" name="price" placeholder="No ingresar nada para no tomarlo en cuenta">

                            @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                        <label for="age" class="col-md-4 control-label">Edad Estimada</label>

                        <div class="col-md-6">
                            <select class="form-control" name="age">
                              <option value="-1">No modificar para no tomarlo en cuenta</option>
                              @for ($i=0; $i < 100; $i++) {
                                <option value="{{$i}}">{{$i}}</option>
                              @endfor
                            </select>

                            @if ($errors->has('age'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('age') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn glyphicon glyphicon-search"></i> Buscar Regalo
                            </button>
                        </div>
                    </div>

                  <form>
                </div>
            </div>
      {{--Important Products section start's here--}}
      <div class="panel panel-success">
        <div class="panel panel-heading">Productos Destacados</div>
        <div class="panel panel-body">
          <div class="col-md-12">
            @if(!$products->isEmpty())
              @foreach($products as $product)
                @if(!$product->stock <= 0)
                  <div class="col-xs-6 col-sm-3" id="div-{{$product->id}}">
                    <div class="thumbnail">
                      <img src="/images/product/avatar/{{$product->productAvatar}}" />
                      <div class="caption">
                        <div class="" style="height: 40px"><h4 ><a href="viewProduct/{{$product->id}}" >{{$product->title}}</a></h4></div>
                        <div>$ {{$product->price}}</div>
                        <div>{{$product->category->name}}</div>
                        <div>{{$product->condition}}</div>
                        <div>Stock: {{$product->stock}}</div>
                        <div>Usuario: <a href="/viewUser/{{$product->user->id}}">{{$product->user->name}}</a> </div>
                        <br>
                        @if(Auth::check() && Auth::user() != $product->user)
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
                @endif
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/wishlist.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/shoplist.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/deleteProduct.js') }}"></script>
@endsection
