<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecord=[
           ['id'=>1, 'category_id'=>3,'section_id'=>2,'product_name'=>'Armani Pant','product_code'=>202,'product_color'=>'Black','product_price'=>155,'product_discount'=>0,'product_weight'=>'305g','product_video'=>"",'product_image'=>'','product_description'=>'','wash_care'=>'','fabric'=>'Cotton','pattern'=>'','sleeve'=>'Full sleeve','fit'=>'semi-fit','occasion'=>'Summer','meta_title'=>'','meta_description'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'Yes','status'=>1],
           ['id'=>2, 'category_id'=>2,'section_id'=>1,'product_name'=>'Denim Pant','product_code'=>203,'product_color'=>'Black','product_price'=>188,'product_discount'=>0,'product_weight'=>'305g','product_video'=>"",'product_image'=>'','product_description'=>'','wash_care'=>'','fabric'=>'Cotton','pattern'=>'','sleeve'=>'Full sleeve','fit'=>'semi-fit','occasion'=>'Summer','meta_title'=>'','meta_description'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'Yes','status'=>1],
        ];
        Product::insert($productRecord);
    }
}
