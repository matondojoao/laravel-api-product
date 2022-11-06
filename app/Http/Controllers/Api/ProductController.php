<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=product::all();

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product=new product();

        $product->name=$request->name;
        $product->price=$request->price;
        $product->description=$request->description;
        $product->slug=$request->slug;
        $product->save();

        return response()->json(['data'=>['msg'=>'Produto salvo com sucesso']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=product::find($id);
            if(isset($product)){
              return response()->json($product);
            }
        return response()->json(['data'=>['msg'=>'Produto não encontrado']]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=product::find($id);

        if(isset($product)){

            $product->name=$request->name;
            $product->price=$request->price;
            $product->description=$request->description;
            $product->slug=$request->slug;
            
            $product->save();
            
            return response()->json(['data'=>['msg'=>'Produto atualizado com sucesso']]);
        }
        return response()->json(['data'=>['msg'=>'Produto não encontrado']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $product=product::find($id);
            if(isset($product)){
              $product->delete();
              return response()->json(['data'=>['msg'=>'Produto excluído com sucesso']]);
            }
        return response()->json(['data'=>['msg'=>'Produto não encontrado']]);
    }
}
