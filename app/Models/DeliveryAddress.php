<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DeliveryAddress extends Model
{
    use HasFactory;

    public static function DeliveryAddresses(){

        $user_id = Auth::user()->id;
        $addresses = DeliveryAddress::where('user_id',$user_id)->get()->toArray();
        return $addresses;

    }
}
