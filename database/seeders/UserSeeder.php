<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\DB; 


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
            'name' => 'Ferdbite',
            'fullname' => "Ferdbite Simpletech",
            'phone' => '08032934439',
            'email' => 'info@simpletech.com.ng',
            'password' => Hash::make('betterpeter'),
        ]);
    }
}
