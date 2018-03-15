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
        $status = Status::create(['name' => 'Confirmed by Seller']);
        $status = Status::create(['name' => 'Pending by System']);
        $status = Status::create(['name' => 'Cancelled by Seller']);
        $status = Status::create(['name' => 'Cancelled by System']);
        $status = Status::create(['name' => 'Cancelled by User']);
    }
}
