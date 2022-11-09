<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $products = new product;

      if($request->has('conditions')){
       $expressions=explode(';',$request->get('conditions'));
        
       foreach($expressions as $e){
          $exp=explode(':',$e);
          $products=$products->where($exp[0],$exp[1],$exp[2]);
       }
     }
      if($request->has('fields')){
        $fields=$request->get('fields');
        $products=$products->selectRaw($fields);
      }
       
      return new ProductCollection($products->paginate(3));
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
              //return response()->json($product);
             return new ProductResource($product);
            }
        //return response()->json(['data'=>['msg'=>'Produto não encontrado']]);
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
