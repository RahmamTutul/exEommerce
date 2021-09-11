<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class couponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $couponData= [
         [ 'id'=>1, 'coupon_option'=>'Manual', 'coupon_code'=>'test10','categories'=>'1,2', 'users'=>'ral@yopmail.com, rahmantutul50@yopmail.com', 'coupon_type'=>'Single', 'amount_type'=>'percentage', 'amount'=>10, 'expiry_date'=>'2021-3-7','status'=>1,],
      ];
      Coupon::insert($couponData);
    }
}
