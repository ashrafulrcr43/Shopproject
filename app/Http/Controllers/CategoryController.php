<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryPage(){
        return view('pages.dashboard.category-list');
    }
    public function categoryList(Request $request){
        $user_id =$request->header('id');
        return category::where('user_id',$user_id)->get();
    }
    public function categoryCreate(Request $request){
        $user_id =$request->header('id');
        return category::create([
            'name'=>$request->input('name'),
            'user_id'=> $user_id
        ]);
    }
    public function categoryDelete(Request $request){
        $category_id = $request->input('id');
        $user_id = $request->header('id');

        return category::where('id',$category_id)
        ->where('user_id',  $user_id)->delete();
    }  
    public function categoryUpdate(Request $request){
        $category_id = $request->input('id');
        $user_id = $request->header('id');

        return category::where('id',$category_id)
        ->where('user_id',  $user_id)->update([
            'name'=>$request->input('name')
        ]);

    }
    public function categoryById(Request $request){
        // sleep(2);
        $category_id=$request->input('id');
        $user_id=$request->header('id');
        return Category::where('id',$category_id)->where('user_id',$user_id)->first();
    }
}
