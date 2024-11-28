<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\invoice;
use App\Models\InvoiceProduct;
use App\Models\customer;
use Exception;

class InvoiceController extends Controller
{
    public function InvoicePage(){
        return view('pages.invoice.Invoice-page');
    }
    public function SalesPage(){
        return view('pages.invoice.Sales-page');
    }
    public function CreateInvoice(Request $request){

        DB::beginTransaction();
        try{
            $user_id = $request->header('id');
            $total = $request->input('total');
            $discount = $request->input('discount');
            $vat = $request->input('vat');
            $payable = $request->input('payable');
            $customer_id = $request->input('customer_id');

        $invoice = invoice::create([
            'total'=> $total,
            'discount'=> $discount,
            'vat'=> $vat,
            'payable'=> $payable,
            'user_id'=> $user_id,
            'customer_id'=> $customer_id,
        ]);
        $invoiceID = $invoice->id;
        $products = $request->input('products');
        foreach($products as $eachProduct){
            InvoiceProduct::create([
                'invoice_id'=>$invoiceID,
                'user_id'=>$user_id,
                'product_id'=>$eachProduct['product_id'],
                'qty'=>$eachProduct['qty'],
                'sale_price'=>$eachProduct['sale_price'],
            ]);
        }
        DB::commit();
        return 1;

        }catch(Exception $e){
            DB::rollBack();
            return 0;
        };
    }
    public function SelectInvoice(Request $request){
        $user_id = $request->header('id');
        return invoice::where('user_id',$user_id)->with('customer')->get();
    }
    public function DetailsInvoice(Request $request){
        $user_id =$request->header('id');
        $customerDetails = customer::where('user_id',$user_id)
        ->where('id',$request->input('cus_id'))->get();
        $invoiceTotal = customer::where('user_id',$user_id)
        ->where('id',$request->input('inv_id'))->get();
        $invoiceProduct =InvoiceProduct::where('invoice_id',$request->input('inv_id'))
        ->where('user_id',$user_id)->with('product')->get();
        return array([
            'customer'=>$customerDetails,
            'invoice'=>$invoiceTotal,
            'product'=>$invoiceProduct,
        ]);
    }
    public function DeleteInvoice(Request $request){
        DB::beginTransaction();
        try{
            $user_id =$request->header('id');
            InvoiceProduct::where('invoice_id',$request->input('inv_id'))
            ->where('user_id',$user_id)->delete();
            invoice::where('id',$request->input('inv_id'))->delete();
            DB::commit();
            return 1;
        }catch(Exception $e){
            DB::rollback();
            return 0;
        }
    }
}
