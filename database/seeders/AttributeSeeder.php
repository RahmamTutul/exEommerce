<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributeData=[
            ['id'=>1,'product_id'=>1, 'price'=>1200,'stock'=>200,'sku'=>'T-1','status'=>1, 'size'=>'small'],
            ['id'=>2,'product_id'=>1, 'price'=>1300,'stock'=>150,'sku'=>'T-2','status'=>1, 'size'=>'medium'],
            ['id'=>3,'product_id'=>1, 'price'=>1400,'stock'=>150,'sku'=>'T-3','status'=>1, 'size'=>'medium'],
        ];
        ProductAttribute::insert($attributeData);
    }

}
