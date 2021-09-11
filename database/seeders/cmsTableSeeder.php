<?php

namespace Database\Seeders;

use App\Models\CMS;
use Illuminate\Database\Seeder;
class cmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cmsInfo=[
            ['id'=>1,'title'=>'About us', 'description'=>'Content is coming soon..!', 'meta_title'=>'about us', 'meta_description'=>'This content is all about us pages','meta_keywords'=>'some keywords up here..!', 'url'=>'about us', 'status'=>1, ],
            ['id'=>2,'title'=>'Privacy policy', 'description'=>'Content is coming soon..!', 'meta_title'=>'Privacy policy', 'meta_description'=>'This content is all Privacy policy pages','meta_keywords'=>'some keywords up here..!', 'url'=>'Privacy policy', 'status'=>1, ],

        ];
        CMS::insert($cmsInfo);
    }
}
