<?php

use App\Models\Image;
use App\Models\Shops\Store;
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
            'description' => 'lorem ipsum....',
        ])->image()->create([
            'path' => Image::STORE_DEFAULT
        ]);
    }
}
