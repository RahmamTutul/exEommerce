<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(AdminsTableSeeder::class);
        // $this->call(SectionsTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(ProductTableSeeder::class);
        // $this->call(AttributeSeeder::class);
        // $this->call(ProductImageTableSeeder::class);
        // $this->call(BrandsTableSeeder::class);
        // $this->call(BannerTableSeeder::class);
        // $this->call(couponsTableSeeder::class);
        // $this->call(DeliveryAddressTableSeeder::class);
        // $this->call(OrderStatusTableSeeeder::class);
        // $this->call(cmsTableSeeder::class);
        $this->call(RattingTableSeeder::class);
    }
}
