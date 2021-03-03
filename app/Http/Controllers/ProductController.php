<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(product::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$createProduct = create($request->all());
        $createProduct = new product();
        $createProduct->code = $request->code;
        $createProduct->name = $request->name;
        $createProduct->stock = $request->stock;
        $createProduct->price = $request->price;
        $product = $createProduct->save();
        if($product){
            return response()->json(['message'=>'Product created successfully'], 201);
        }else{
            return response()->json(['message'=>'Error'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $byIdProduct = product::find($id);
        if(is_null($byIdProduct)){
            return response()->json(['message'=>'Product not found'], 404);
        }
        return response()->json($byIdProduct::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateProduct = product::find($id);
        if(is_null($updateProduct)){
            return response()->json(['message'=>'Product not found'], 404);
        }
        //$updateProduct = update($request->all());
        $updateProduct->code = $request->code;
        $updateProduct->name = $request->name;
        $updateProduct->stock = $request->stock;
        $updateProduct->price = $request->price;
        $product = $updateProduct->save();
        return response()->json(['message'=>'Product updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $deleteProduct = product::find($id);
        if(is_null($deleteProduct)){
            return response()->json(['message'=>'Product not found'], 404);
        }
        $deleteProduct->delete();
        return response()->json(['message'=>'Product deleted successfully'], 204);
    }
}
