@extends('layouts.app')

@section('content')
<div class="container">
  <div class="pull-left" style="width: 50%">
    <img src="/images/avatar/{{$user->avatarPath}}" class="img-responsive" />
  </div>
  <div class="pull-left" style="width: 50%">
    <h2 class="text-center">{{$user->name}} {{$user->lastName}}</h2>
    <h4 class="text-center">{{$user->email}}</h4>
    @if($user == Auth::user())
      <div><a class="btn btn-success center-block" href="/myProducts">Ver Productos</a></div>
    @else
      <div><a class="btn btn-success center-block" href="/userProducts/{{$user->id}}">Ver Productos</a></div>
    @endif
  </div>
</div>
@endsection
