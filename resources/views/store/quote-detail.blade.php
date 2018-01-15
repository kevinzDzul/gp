@extends('store.template')

@section('content')

    <div class="container text-center">
        <div class="page-header">
            <h1><i class="fa fa-shopping-cart"></i> Detalle de pedidos para cotizar</h1>
        </div>

        <div class="page">
            <div class="table-responsive">
                <h3>Datos del usuario</h3>
                <table class="table table-striped table-hover table-bordered">
                    <tr><td>Nombre:</td><td>{{ Auth::user()->name . " " . Auth::user()->last_name }}</td></tr>
                    <tr><td>Usuario:</td><td>{{ Auth::user()->user }}</td></tr>
                    <tr><td>Correo:</td><td>{{ Auth::user()->email }}</td></tr>
                    <tr><td>Dirección:</td><td>{{ Auth::user()->address }}</td></tr>
                </table>
            </div>
            <div class="table-responsive">
                <h3>Datos del pedido</h3>
                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                    </tr>
                    @foreach($cart as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                </table><hr>
                <h3>
					<!--span class="label label-success">
					</span-->
                </h3><hr>
                <p>
                    <a href="{{ route('quote-cart-show') }}" class="btn btn-primary">
                        <i class="fa fa-chevron-circle-left"></i> Regresar
                    </a>

                    <a href="#" class="btn btn-warning">
                        Enviar solicitud<!--i class="fa fa-cc-paypal fa-2x"></i-->
                    </a>
                </p>
            </div>
        </div>
    </div>

@stop