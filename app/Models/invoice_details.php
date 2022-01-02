<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_details extends Model
{
    use HasFactory;
    public $fillable=['product_name','product_unit','quantity','product_price','sub_total_product','invoice_id'];


    public function invoice(){


        return $this->belongsTo("app\Models\invoice","invoice_id");
    }
}
