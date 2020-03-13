@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Producto</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/editProduct/' . $product->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $product->title }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Precio</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" value="{{ $product->price }}">

                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                            <label for="stock" class="col-md-4 control-label">Stock</label>

                            <div class="col-md-6">
                                <input id="stock" type="text" class="form-control" name="stock" value="{{ $product->stock }}">

                                @if ($errors->has('stock'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stock') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ageMin') ? ' has-error' : '' }}">
                            <label for="ageMin" class="col-md-4 control-label">Edad Mínima Recomendada</label>

                            <div class="col-md-6">
                                <input id="ageMin" type="text" class="form-control" name="ageMin" value="{{ $product->ageMin }}">

                                @if ($errors->has('ageMin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ageMin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ageMax') ? ' has-error' : '' }}">
                            <label for="ageMax" class="col-md-4 control-label">Edad Máxima Recomendada</label>

                            <div class="col-md-6">
                                <input id="ageMax" type="text" class="form-control" name="ageMax" value="{{ $product->ageMax }}">

                                @if ($errors->has('ageMax'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ageMax') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('condition') ? ' has-error' : '' }}">
                            <label for="condition" class="col-md-4 control-label">Condicion</label>

                            <div class="col-md-6">
                                <select class="form-control" name="condition" id="condition">
                                  <option value="new">Nuevo</option>
                                  <option value="used" @if($product->condition=='used')selected @endif >Usado</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-4 control-label">Categoria</label>

                            <div class="col-md-6">
                                <select class="form-control" name="category" id="category">
                                  @foreach($categories as $category)
                                      <option value="{{$category->id}}" @if($product->category->parentCategory->id==$category->id)selected @endif >{{$category->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subCategory') ? ' has-error' : '' }}">
                            <label for="subCategory" class="col-md-4 control-label">Sub Categoria</label>

                            <div class="col-md-6">
                                <select class="form-control" name="subCategory" id="subCategory">
                                  @foreach($subCategories as $subCategory)
                                    <option value="{{$subCategory->id}}" @if ($product->category->id==$subCategory->id)selected @endif >{{$subCategory->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password Usuario</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Precio</label>

                            <div class="col-md-6">
                                <textarea name="description" rows="8" cols="40">{{$product->description}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                      <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                          <label for="avatar" class="col-md-4 control-label">Subir Avatar:</label>

                          <div class="col-md-6">
                            <input id="avatar" type="file" class="form-control" name="avatar">
                              @if ($errors->has('avatar'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('avatar') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn glyphicon glyphicon-pencil"></i> Editar
                                </button>
                            </div>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/editProduct.js') }}"></script>
@endsection
