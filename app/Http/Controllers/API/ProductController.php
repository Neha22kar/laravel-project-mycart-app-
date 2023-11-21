<?php

namespace  App\Http\Controllers\API;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Respose
     */
    public function index()
    {
        $products = Product::all();
        return response(['products' => ProductResource::collection($products)]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'Brand' => 'required|max:255',
            'Model'  => 'required|max:255',
            'Memory' => 'required|max:255',
            'RAM' => 'required|max:255',
            'Camera' => 'required|max:255',
            'Price' => 'required|max:255',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(),'Validaion Error']);

        }

        $product = Product::create($data);

        return response(['product' => new ProductResource($product),'message' => 'Product created successfully']);
    
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response(['product' => new ProductResource($product)]);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Product $product)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'Brand' => 'required|max:255',
            'Model'  => 'required|max:255',
            'Memory' => 'required|max:255',
            'RAM' => 'required|max:255',
            'Camera' => 'required|max:255',
            'Price' => 'required|max:255',

        ]);

        if($validator->fails()) {
            return response(['error' => $validator->errors(),'Validation Error']);

        }
        
        $product->update($data);

        return response(['product' => new ProductResource($product),'message' => 'Product updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response(['message' => 'Product deleted successfully']);
    }
}
