<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $CategoryRecord=[
            ['id'=>1 , 'parent_id'=> 0, 'section_id'=>1 , 'category_name'=>'T-shirt','category_image'=>'','category_discount'=>0, 'url'=>'t-shirt','description'=>'In Part-19 of Advance E-com Series in Laravel 7, we will start working on Categories module. We will create categories table with migration and will also add one category in it with Seeding though later on we will add category from admin panel.','meta_title'=>'t-shirt','meta_description'=>'','meta_keywords'=>'', 'status'=>1],
            ['id'=>2 , 'parent_id'=> 1, 'section_id'=>1 , 'category_name'=>'Casual T-shirt','category_image'=>'','category_discount'=>0, 'url'=>'casual-t-shirt','description'=>'In Part-19 of Advance E-com Series in Laravel 7, we will start working on Categories module. We will create categories table with migration and will also add one category in it with Seeding though later on we will add category from admin panel.','meta_title'=>'t-shirt','meta_description'=>'','meta_keywords'=>'', 'status'=>1],

         ];
         Category::insert($CategoryRecord);
    }
}
