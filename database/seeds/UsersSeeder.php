<?php

use App\Models\Image;
use App\Models\Users\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = Image::USER_DEFAULT;

        $user = factory(User::class)->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole('admin');
        $user->image()->create(['path' => $image]);

        $user = factory(User::class)->create([
            'name' => 'sellerUser',
            'email' => 'sellerUser@example.com',
        ]);
        $user->assignRole('user', 'seller');
        $user->image()->create(['path' => $image]);

        $user = factory(User::class)->create([
            'name' => 'user',
            'email' => 'user@example.com',
        ]);
        $user->assignRole('user');
        $user->image()->create(['path' => $image]);
    }
}
