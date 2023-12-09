<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("users")->insert([
            [
                'name' => 'CongTu',
                'email' => "tct3182004@gmail.com",
                'phone' => '0352029544',
                'password' => Hash::make('111'),
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'TruongCongTu',
                'email' => "tct31082004@gmail.com",
                'phone' => '0972722153',
                'password' => Hash::make('111'),
                'role' => 'user',
                'remember_token' => Str::random(10),
            ],

        ]);

    }
}
