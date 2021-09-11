<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImage=[
            ['id'=>1, 'image'=>'2021-01-13-5ffeb345db278-jpg', 'product_id'=>11, 'status'=>1],
            ['id'=>2, 'image'=>'2021-01-13-5ffeb345db278-jpg', 'product_id'=>11, 'status'=>1],
            ['id'=>3, 'image'=>'2021-01-13-5ffeb345db278-jpg', 'product_id'=>11, 'status'=>1],
            ['id'=>4, 'image'=>'2021-01-13-5ffeb345db278-jpg', 'product_id'=>11, 'status'=>1],
        ];
        ProductImage::insert($productImage);
    }
}
