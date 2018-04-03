<?php

use App\Models\Process\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name' => 'Confirmed by Seller']);
        Status::create(['name' => 'Pending by System']);
        Status::create(['name' => 'Cancelled by Seller']);
        Status::create(['name' => 'Cancelled by System']);
        Status::create(['name' => 'Cancelled by User']);
    }
}
