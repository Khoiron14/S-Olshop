<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(ItemsAndCategoriesSeeder::class);
        $this->call(StatusSeeder::class);
    }
}
