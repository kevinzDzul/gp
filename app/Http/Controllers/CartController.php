<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;

class CartController extends Controller
{
	public function __construct()
	{
		if(!\Session::has('cart')) \Session::put('cart', array());

        if(!\Session::has('quote-cart')) \Session::put('quote-cart', array());
	}

    // Show cart
    public function show()
    {
    	$cart = \Session::get('cart');
    	$total = $this->total();
    	return view('store.cart', compact('cart', 'total'));
    }

    // Add item
    public function add(Product $product)
    {
    	$cart = \Session::get('cart');
    	$product->quantity = 1;
    	$cart[$product->slug] = $product;
    	\Session::put('cart', $cart);

    	return redirect()->route('cart-show');
    }

    // Delete item
    public function delete(Product $product)
    {
    	$cart = \Session::get('cart');
    	unset($cart[$product->slug]);
    	\Session::put('cart', $cart);

    	return redirect()->route('cart-show');
    }

    // Update item
    public function update(Product $product, $quantity)
    {
    	$cart = \Session::get('cart');
    	$cart[$product->slug]->quantity = $quantity;
    	\Session::put('cart', $cart);

    	return redirect()->route('cart-show');
    }

    // Trash cart
    public function trash()
    {
    	\Session::forget('cart');

    	return redirect()->route('cart-show');
    }

    // Total
    private function total()
    {
    	$cart = \Session::get('cart');
    	$total = 0;
    	foreach($cart as $item){
    		$total += $item->price * $item->quantity;
    	}

    	return $total;
    }

    // Detalle del pedido
    public function orderDetail()
    {
        if(count(\Session::get('cart')) <= 0) return redirect()->route('home');
        $cart = \Session::get('cart');
        $total = $this->total();

        return view('store.order-detail', compact('cart', 'total'));
    }

    /** Carrito cotizador ---------------------*/

    //agregar un producto para cotizar
    public function addQuoteCart(Product $product){

        $cart = \Session::get('quote-cart');
        $product->quantity = 1;
        $cart[$product->slug] = $product;
        \Session::put('quote-cart', $cart);

        return redirect()->route('quote-cart-show');

    }

    //mostrar los productos a cotizar
    public function showItemsQuoteCart(){
        $cart = \Session::get('quote-cart');
        $total = $this->totalQuoteCart();
        return view('store.quote-cart', compact('cart', 'total'));
    }

    //borrar un producto del carrito cotizador
    public function deleteItemQuoteCart(Product $product){
        $cart = \Session::get('quote-cart');
        unset($cart[$product->slug]);
        \Session::put('quote-cart', $cart);
        return redirect()->route('quote-cart-show');
    }

    // Total carrito cotizador
    private function totalQuoteCart()
    {
        $cart = \Session::get('quote-cart');
        $total = 0;
        foreach($cart as $item){
            $total += $item->price * $item->quantity;
        }

        return $total;
    }

    // Actualizar cantidad de productos a cotizar
    public function updateItemQuoteCart(Product $product, $quantity)
    {
        $cart = \Session::get('quote-cart');
        $cart[$product->slug]->quantity = $quantity;
        \Session::put('quote-cart', $cart);

        return redirect()->route('quote-cart-show');
    }

    //limpiar el carrito por completo
    public function trashItemsQuoteCart(){
        \Session::forget('quote-cart');
        return redirect()->route('quote-cart-show');
    }

    // Detalle del pedido para cotizar
    public function orderQuoteCartDetail()
    {
        if(count(\Session::get('quote-cart')) <= 0) return redirect()->route('home');
        $cart = \Session::get('quote-cart');
        //$total = $this->totalQuoteCart();

        return view('store.quote-detail', compact('cart'));
    }
}
