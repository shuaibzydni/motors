<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "Manikandan B",
                "email" => "xqsit94@gmail.com",
                "password" => "password",
            ],
            [
                "name" => "Guna",
                "email" => "guna@zydni.com",
                "password" => "password",
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
