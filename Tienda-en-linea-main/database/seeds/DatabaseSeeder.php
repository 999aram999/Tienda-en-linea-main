<?php

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
        $this->call(PaymentPlatformSedeer::class);//PaymentPlatformSedeer
        $this->call(CurrencySeeder::class);//CurrencySeeder
        $this->call(PermissionTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        factory(App\Tag::class,10)->create();
        factory(App\Category::class,10)->create();
        factory(App\Subcategory::class,10)->create();
        factory(App\Product::class,10)->create();

    }
}
