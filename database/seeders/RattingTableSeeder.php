<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;

class RattingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rattingData=[
           ['id'=>1, 'user_id'=>3,'product_id'=>10, 'retting'=>4,'review'=>'It looks good', 'status'=>1],
           ['id'=>2, 'user_id'=>4,'product_id'=>12, 'retting'=>5,'review'=>'It looks excellent', 'status'=>1],
           ['id'=>3, 'user_id'=>5,'product_id'=>15, 'retting'=>2,'review'=>'It looks bad', 'status'=>1],
        ];
        Rating::insert($rattingData);
    }
}
