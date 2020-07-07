<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Yunus Emre KOCABAY',
            'email' => 'truewd@hotmail.com',
            'password' => bcrypt('45783094')
        ]);
        $user->assignRole('administrator');

    }
}
