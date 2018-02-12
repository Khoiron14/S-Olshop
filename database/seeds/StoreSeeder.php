<?php

use App\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::create([
            'user_id' => 2,
            'name' => 'Maju jaya Abadi',
            'domain' => 'MJAstore',
            'description' => 'Bertarunglah dragon ball, dengan segala kemampuan yang ada. Bila kembali dari langit, semoga hidup kan jadi lebih baik',
        ]);
    }
}
