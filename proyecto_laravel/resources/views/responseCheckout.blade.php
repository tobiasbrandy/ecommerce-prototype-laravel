@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10">
    @if($response == 'success' || $response == 'pending')

    <div class="alert alert-success" role="alert">
      Su compra se ha efectuado sin problemas. Muchas gracias!
      Será redirigido a nuestra página principal en <strong id="span">5</strong> segundos.
    </div>
  @else
    <div class="alert alert-danger" role="alert">
      Oh no! Ocurrió un error en el proceso de compra. Todos las productos siguen en su carrito de compras para que lo intente de nuevo.
      Será redirigido a nuestra página principal en <strong id="span">5</strong> segundos.
    </div>
  @endif
  </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/responseCheckout.js') }}"></script>
@endsection
