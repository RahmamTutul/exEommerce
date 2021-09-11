<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory;
     public static function getShippingCharges($country){
       $shippingDetails = Order::where('country', $country)->first()->toArray();
       $shipping_charge = $shippingDetails['shipping_charges'];
       return $shipping_charge;
     }
}
