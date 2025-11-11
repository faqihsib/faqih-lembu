<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data['name'] = 'Admin';
        $data['email'] = 'faqih@email.com';
        $data['password'] = Hash::make('faqih123');

        User::create($data); //->eloquent
    }
}
