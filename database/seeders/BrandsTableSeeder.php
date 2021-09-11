<?php

namespace Database\Seeders;

use App\Models\Brands;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandsData=[
            ['id'=>1, 'name'=>'Armani', 'status'=>1],
            ['id'=>2, 'name'=>'REX', 'status'=>1],
            ['id'=>3, 'name'=>'Tanjim', 'status'=>1],
            ['id'=>4, 'name'=>'Infinity', 'status'=>1],
            ['id'=>5, 'name'=>'Bong', 'status'=>1],
        ];
        Brands::insert($brandsData);
    }
}
