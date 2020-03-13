@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/registerProduct/') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Titulo</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">

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
                                <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}">

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
                                <input id="stock" type="text" class="form-control" name="stock" value="{{ old('stock') }}">

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
                                <input id="ageMin" type="text" class="form-control" name="ageMin" value="{{ old('ageMin') }}">

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
                                <input id="ageMax" type="text" class="form-control" name="ageMax" value="{{ old('ageMax') }}">

                                @if ($errors->has('ageMax'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ageMax') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Categoría</label>

                            <div class="col-md-6">
                                <select class="form-control" name="category" id="category">
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

                        <div class="form-group{{ $errors->has('subCategory') ? ' has-error' : '' }}">
                            <label for="subCategory" class="col-md-4 control-label">Sub Categoría</label>

                            <div class="col-md-6">
                                <select class="form-control" name="subCategory" id="subCategory">

                                </select>

                                @if ($errors->has('subCategory'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subCategory') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('condition') ? ' has-error' : '' }}">
                            <label for="condition" class="col-md-4 control-label">Condición</label>

                            <div class="col-md-6">
                                <select class="form-control" name="condition">
                                  <option value="new">Nuevo</option>
                                  <option value="used">Usado</option>
                                </select>

                                @if ($errors->has('condition'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('condition') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Descripción</label>

                            <div class="col-md-6">
                                <textarea name="description" rows="8" cols="40" class="form-control" id="description" >{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('productAvatar') ? ' has-error' : '' }}">
                            <label for="productAvatar" class="col-md-4 control-label">Imagen Producto:</label>

                            <div class="col-md-6">
                              <input id="productAvatar" type="file" class="form-control" name="productAvatar">
                                @if ($errors->has('productAvatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('productAvatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar Producto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/registerProduct.js') }}"></script>

@endsection
