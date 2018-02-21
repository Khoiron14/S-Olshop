<?php

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
        $user = factory(User::class)->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole('admin');
        $user->image()->create(['path' => 'seeds/user.png']);

        $user = factory(User::class)->create([
            'name' => 'sellerUser',
            'email' => 'sellerUser@example.com',
        ]);
        $user->assignRole('user', 'seller');

        $user = factory(User::class)->create([
            'name' => 'user',
            'email' => 'user@example.com',
        ]);
        $user->assignRole('user');
    }
}
