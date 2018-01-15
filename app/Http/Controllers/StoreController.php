<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;

class StoreController extends Controller
{
    const DEFAULT_FOLDER_IMAGE = "/images/imagesProduct/";

    public function index()
    {
    	$products = Product::all();
        foreach ($products as $product){
            $product->image = url(self::DEFAULT_FOLDER_IMAGE).'/'.$product->image;
        }

    	return view('store.index', compact('products'));
    }

    public function show($slug)
    {
    	$product = Product::where('slug', $slug)->first();
        $product->image = url(self::DEFAULT_FOLDER_IMAGE).'/'.$product->image;

    	//dd($product);

    	return view('store.show', compact('product'));
    }
}
