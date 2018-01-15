@extends('store.template')

@section('content')
<div class="container text-center">
	<div class="page-header">
	  <h1><i class="fa fa-shopping-cart"></i> Detalle del producto</h1>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="product-block">
				<img src="{{ $product->image }}">
			</div>	
		</div>
		<div class="col-md-6">
			<div class="product-block">
				<h3>{{ $product->name }}</h3><hr>
				<div class="product-info panel">
					<p>{{ $product->description }}</p>
					<h3>
						@if($product->type_sale_id == 2)
						<span class="label label-success">Precio: ${{ number_format($product->price,2) }}</span>
						@else
						<span class="label label-info">Cotizable</span>
						@endif

					</h3>
					<p>

						@if($product->type_sale_id == 2)
						<a class="btn btn-warning btn-block" href="{{ route('cart-add', $product->slug) }}">
							Quiero cotizar <i class="fa fa-cart-plus fa-2x"></i>
						</a>
						@else
							<a class="btn btn-warning btn-block" href="{{ route('quote-cart-add', $product->slug) }}">
								Quiero cotizar <i class="fa fa-cart-plus fa-2x"></i>
							</a>
						@endif

					</p>
				</div>
			</div>	
		</div>
	</div><hr>

	<p>
		<a class="btn btn-primary" href="{{ route('home') }}">
			<i class="fa fa-chevron-circle-left"></i> Regresar
		</a>
	</p>
</div>
@stop