<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name"=>"Ali_Al_Noufal",
            "address"=>"syria",
            "email"=>"alinoufal@gmail.com",
            "password"=>Hash::make("123123123"),
            "phone"=>"0912345678",
            'about_me'=>"test",
            'yearsOfExperiance'=>"1",
            'projectNumber'=>"4"
        ]);
    }
}
