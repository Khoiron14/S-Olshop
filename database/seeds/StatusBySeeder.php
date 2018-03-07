<?php

use App\Models\Process\StatusBy;
use Illuminate\Database\Seeder;

class StatusBySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = StatusBy::create(['name' => 'user']);
        $status = StatusBy::create(['name' => 'seller']);
        $status = StatusBy::create(['name' => 'system']);
    }
}
