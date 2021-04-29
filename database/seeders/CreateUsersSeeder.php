<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'User',
                'username' => 'User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('12345'),
                'photo' => 'image.png',
                'roles_id' => 2
            ],
            [
                'name' => 'Admin',
                'username' => 'Admin',
                'email' => 'kridwan95@gmail.com',
                'password' => bcrypt('Cognos24'),
                'photo' => 'images.png',
                'roles_id' => 1
            ]
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
