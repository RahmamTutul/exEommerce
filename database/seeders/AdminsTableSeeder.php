<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('admins')->delete();
         $adminRecords = [
            [
                'id'=>1,
                'name'=>'Admin',
                'type'=>'admin',
                'mobile'=>'01881053602',
                'email'=>'rahmantutul50@gmail.com',
                'password'=>Hash::make('12345678'),
                'image'=>'',
                'status'=>1

            ],
            [
                'id'=>2,
                'name'=>'Tutul',
                'type'=>'subadmin',
                'mobile'=>'01881053603',
                'email'=>'abc@gmail.com',
                'password'=>Hash::make('12345678'),
                'image'=>'',
                'status'=>1

            ],
            [
                'id'=>3,
                'name'=>'Atanu',
                'type'=>'subadmin',
                'mobile'=>'01881053604',
                'email'=>'abcd@gmail.com',
                'password'=>Hash::make('12345678'),
                'image'=>'',
                'status'=>1

            ],
         ];

         foreach($adminRecords as $key => $records){
             \App\Models\Admin::create($records);
         }


    }
}
