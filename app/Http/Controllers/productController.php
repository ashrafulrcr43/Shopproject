<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class productController extends Controller
{
    public function ProductPage(){
        return view('pages.product.product-list');
    }
    public function ProductCreate(Request $request){

        $user_id = $request->header('id');
        //product image 
        $img=$request->file('img');
       $time = time();

       $fileName = $img->getClientOriginalName();
       $imageName = $user_id.'_'.$time.'_'.$fileName;
       $imageUrl ="uploads/{$imageName}";
       $img->move(public_path('uploads'),$imageName);
        //Store Database

    return product::create([
        'name'=>$request->input('name'),
        'price'=>$request->input('price'),
        'unit'=>$request->input('unit'),
        'img_url'=>$imageUrl,
        'user_id'=>$user_id,
        'category_id'=>$request->input('category_id'),

    ]);

    }
    public function DeleteProduct(Request $request){
        $user_id =$request->header('id');
        $product_id = $request->input('id');
        $filePath = $request->input('file_path');
        File::delete( $filePath);
        return product::where('user_id',$user_id)->where('id', $product_id)->delete();
    }

    public function ProductId(Request $request){
        $user_id =$request->header('id');
        $product_id = $request->input('id');
        return product::where('user_id', $user_id )->where('id', $product_id)->first();
    }
    public function UpdateProduct(Request $request){
        $user_id =$request->header('id');
        $product_id = $request->input('id');

        if($request->hasFile('img')){
            $img = $request->input('img');
            $time = time();
            $fileName = $img->getClientOriginalName;
            $imageName = $user_id.'_'.$time.'_'.$fileName;
            $imageUrl ="uploads/{$imageName}";
            $img->move(public_path('uploads'),$imageName);

            // delete old image
            $filePath=$request->input('file_path');
            File::delete($filePath);
            return Product::where('id',$product_id)->where('user_id',$user_id)->update([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'unit'=>$request->input('unit'),
            'img_url'=>$imageUrl,
            'category_id'=>$request->input('category_id'),
            ]);
        }else{
            return Product::where('id',$product_id)
            ->where('user_id',$user_id)->update([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'unit'=>$request->input('unit'),
            'category_id'=>$request->input('category_id'),
              ]);
        }
    }
    public function ProductList(Request $request){
        $user_id=$request->header('id');
        return Product::where('user_id',$user_id)->get();
    }
    
}
