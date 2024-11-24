<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;

class Customers extends Controller
{
    function CustomerPage(){
        return view('pages.customer.customerpage');
    }

    function CustomerCreate(Request $request){
        $user_id=$request->header('id');
        return customer::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'phone'=>$request->input('phone'),
            'user_id'=>$user_id
        ]);
    }

    function CustomerList(Request $request){
        $user_id=$request->header('id');
        return customer::where('user_id',$user_id)->get();
    }

    function CustomerDelete(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('id');
        return customer::where('id',$customer_id)->where('user_id',$user_id)->delete();
    }

    function CustomerByID(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('id');
        return customer::where('id',$customer_id)->where('user_id',$user_id)->first();
    }


     function CustomerUpdate(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('id');
        return customer::where('id',$customer_id)->where('user_id',$user_id)->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'phone'=>$request->input('phone'),
        ]);
    }

}
