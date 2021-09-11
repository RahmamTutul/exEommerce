<?php

namespace Database\Seeders;

use App\Models\DeliveryAddress;
use Illuminate\Database\Seeder;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryAddressRecord=[
             [
                 'user_id'=>16,'name'=>'Tutul','address'=>'133/4 East Rampura, Dhaka 1219', 'country'=>'Bangladesh', 'state'=>'Asia', 'city'=>'Dhaka', 'Mobile'=>'01881053602', 'pincode'=>'1219', 'status'=>1
             ],
             [
                'user_id'=>17,'name'=>'Mostafiz','address'=>'133/4', 'country'=>'Bangladesh', 'state'=>'Asia', 'city'=>'Dhaka', 'Mobile'=>'01684258879', 'pincode'=>'1219', 'status'=>1
            ]
        ];
        DeliveryAddress::insert($deliveryAddressRecord);
    }
}
