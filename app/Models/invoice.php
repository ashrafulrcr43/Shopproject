<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','customer_id','total','discount','vat','payable',''];

    function customer(){
        return $this->belongsTo('customer');
    }
    function Invoice_Product(){
        return $this->hasMany('InvoiceProduct');
    }

}
