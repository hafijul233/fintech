<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'id' => 1,
            'name' => 'Hafijul Islam',
            'email' => 'hafijul233@gmail.com',
            'phone_code' => '880',
            'phone' => '(168) 955-3434',
            'password' => Hash::make('password'),
            'street' => 'Shamlapur',
            'city' => 'Savar',
            'state' => 'Dhaka',
            'zipcode' => '1310',
            'country' => 'BD',
            'timezone' => 'Asia/Dhaka',
            'notes' => 'seeder',
        ]);
    }
}
