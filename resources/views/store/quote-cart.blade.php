@extends('store.template')

@section('content')
    <div class="container text-center">
        <div class="page-header">
            <h1><i class="fa fa-shopping-cart"></i> Carrito cotizador de precios</h1>
        </div>

        <div class="table-cart">
            @if(count($cart))

                <p>
                    <a href="{{ route('quote-cart-trash') }}" class="btn btn-danger">
                        Vaciar carrito cotizador <i class="fa fa-trash"></i>
                    </a>
                </p>

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Quitar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart as $item)
                            <tr>
                                <td><img src="{{ $item->image }}"></td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <input
                                            type="number"
                                            min="1"
                                            max="100"
                                            value="{{ $item->quantity }}"
                                            id="product_{{ $item->id }}"
                                    >
                                    <a
                                            href="#"
                                            class="btn btn-warning btn-update-item"
                                            data-href="{{ route('quote-cart-update', $item->slug) }}"
                                            data-id = "{{ $item->id }}"
                                    >
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('quote-cart-delete', $item->slug) }}" class="btn btn-danger">
                                        <i class="fa fa-remove"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><hr>

                    <!--h3>
					<span class="label label-success">
					</span>
                    </h3-->

                </div>
            @else
                <h3><span class="label label-warning">No hay productos en el carrito para cotizar</span></h3>
            @endif
            <hr>
            <p>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <i class="fa fa-chevron-circle-left"></i> Seguir comprando
                </a>

                <a href="{{route('quote-order-detail')}}" class="btn btn-primary">
                    Continuar <i class="fa fa-chevron-circle-right"></i>
                </a>
            </p>
        </div>

    </div>
@stop