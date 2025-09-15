<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name"=>"Ali_Al_Noufal",
            "email"=>"alinoufal@gmail.com",
            "password"=>"123123123",
            "phone"=>"0912345678",
        ]);
    }
}
