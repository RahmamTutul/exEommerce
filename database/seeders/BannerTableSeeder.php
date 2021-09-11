<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $bannerData=[
          [ 'id'=>1,'image'=>'1.jpg','alt'=>'Banner Image','status'=>1,'link'=>'','title'=>'First Banner'],
          [ 'id'=>2,'image'=>'2.jpg','alt'=>'Banner Image','status'=>1,'link'=>'','title'=>'Second Banner'],
          [ 'id'=>3,'image'=>'3.jpg','alt'=>'Banner Image','status'=>1,'link'=>'','title'=>'Third Banner'],
       ];
       Banner::insert($bannerData);
    }
}
