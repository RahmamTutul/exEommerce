<?php

namespace Database\Seeders;

use App\Models\Order_status;
use Illuminate\Database\Seeder;

class OrderStatusTableSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $status=[
          [ 'id'=>1, 'name'=>'New', 'status'=>1],
          [ 'id'=>2, 'name'=>'Pending', 'status'=>1],
          [ 'id'=>3, 'name'=>'Hold', 'status'=>1],
          [ 'id'=>4, 'name'=>'Cancelled', 'status'=>1],
          [ 'id'=>5, 'name'=>'In Progress', 'status'=>1],
          [ 'id'=>6, 'name'=>'Paid', 'status'=>1],
          [ 'id'=>7, 'name'=>'Shipped', 'status'=>1],
          [ 'id'=>8, 'name'=>'Delivered', 'status'=>1],
       ];
       Order_status::insert($status);
    }
}
