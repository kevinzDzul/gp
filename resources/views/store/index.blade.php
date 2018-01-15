@extends('store.template')

@section('content')

@include('store.partials.slider')

<div class="container text-center">
	<div id="products">
		@forelse($products as $product)

			@if($product->type_sale_id == 2)

			<div class="product white-panel">
				<h3>{{ $product->name }}</h3><hr>
				<img src="{{ $product->image }}" width="200">
				<div class="product-info panel">
					<p>{{ $product->extract }}</p>
					<h3><span class="label label-success">Precio: ${{ number_format($product->price,2) }}</span></h3>
					<p>
						<a class="btn btn-warning" href="{{ route('cart-add', $product->slug) }}">
							<i class="fa fa-cart-plus"></i> La quiero
						</a>
						<a class="btn btn-primary" href="{{ route('product-detail', $product->slug) }}"><i class="fa fa-chevron-circle-right"></i> Leer mas</a>
					</p>
				</div>
			</div>

			@else

                <div class="product white-panel">
                    <h3>{{ $product->name }}</h3><hr>
                    <img src="{{ $product->image }}" width="200">
                    <div class="product-info panel">
                        <p>{{ $product->extract }}</p>
                        <h3><span class="label label-info">{{ $product->type_sale->name }}</span></h3>
                        <p>
                            <a class="btn btn-warning" href="{{ route('quote-cart-add', $product->slug) }}">
                                <i class="fa fa-cart-plus"></i> Quiero cotizar
                            </a>
                            <a class="btn btn-primary" href="{{ route('product-detail', $product->slug) }}"><i class="fa fa-chevron-circle-right"></i> Leer mas</a>
                        </p>
                    </div>
                </div>

			@endif

		@empty
			<p>No hay productos disponibles por el momento.</p>

		@endforelse
	</div>
</div>
@stop

