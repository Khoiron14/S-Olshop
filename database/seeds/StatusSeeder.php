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
        $status = Status::create(['name' => 'confirmed']);
        $status = Status::create(['name' => 'pending']);
        $status = Status::create(['name' => 'cancelled']);
    }
}
