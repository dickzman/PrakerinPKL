<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Dicky Mahendra S',
            'email' => 'Dicky@admin.com',
            'password' => \Hash::make('admin'),
        ]);
    }
}
