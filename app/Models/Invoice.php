<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $fillable=['user_id',"customer_name",'customer_email','customer_number','company_name','invoice_number','invoice_date','sub_total','discount','vat','shipping','total'];

    public function invoice_details(){


        return $this->hasMany("App\Models\invoice_details","invoice_id");
    }
}
