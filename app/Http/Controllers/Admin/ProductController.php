<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SaveProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Product;
use App\Category;
use App\TypeSale;

class ProductController extends Controller
{

    const PREFIX_FILE_NAME = "imgProduct";
    const DEFAULT_FOLDER_IMAGE = "/images/imagesProduct/";
    private $pathImages;

    public function __construct()
    {
        $this->pathImages = public_path() . self::DEFAULT_FOLDER_IMAGE;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(5);

        foreach ($products as $product){
            $product->image = url(self::DEFAULT_FOLDER_IMAGE).'/'.$product->image;
        }

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->lists('name', 'id');
        $type_sale = TypeSale::orderBy('id', 'desc')->lists('name', 'id');

        //dd($type_sale);
        //dd($categories);
        return view('admin.product.create', compact('categories','type_sale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(SaveProductRequest $request)
    {
        $file = $request->file('image');

        if($file != null) {
            $fileName = self::PREFIX_FILE_NAME . time() . '.' . $file->getClientOriginalExtension();
            $file->move($this->pathImages, $fileName);

            $data = [
                'name'        => $request->get('name'),
                'slug'        => str_slug($request->get('name')),
                'description' => $request->get('description'),
                'extract'     => $request->get('extract'),
                'price'       => $request->get('price'),
                'image'       => $fileName,
                'type_sale_id'=> $request->get('type_sale_id'),
                'visible'     => $request->has('visible') ? 1 : 0,
                'category_id' => $request->get('category_id')
            ];

            $product = Product::create($data);

        }else{
            $product = false;
        }

        $message = $product ? 'Producto agregado correctamente!' : 'El producto NO pudo agregarse!';

        return redirect()->route('admin.product.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('id', 'desc')->lists('name', 'id');
        $type_sale = TypeSale::orderBy('id', 'desc')->lists('name', 'id');

        return view('admin.product.edit', compact('categories', 'product','type_sale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        if($request->file('image') != null){

            $file = $request->file('image');

            $fileName = self::PREFIX_FILE_NAME . time() . '.' . $file->getClientOriginalExtension();
            $file->move($this->pathImages, $fileName);

            File::delete( $this->pathImages. $product->image);

            $nameFile = $fileName;

        }else{
            $nameFile = $product->image;
        }

        $product->fill($request->all());
        $product->slug  = str_slug($request->get('name'));
        $product->image = $nameFile;
        $product->visible = $request->has('visible') ? 1 : 0;

        $updated = $product->save();

        $message = $updated ? 'Producto actualizado correctamente!' : 'El Producto NO pudo actualizarse!';

        return redirect()->route('admin.product.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Product $product)
    {

        File::delete( $this->pathImages. $product->image);
        $deleted = $product->delete();

        $message = $deleted ? 'Producto eliminado correctamente!' : 'El producto NO pudo eliminarse!';

        return redirect()->route('admin.product.index')->with('message', $message);
    }
}
