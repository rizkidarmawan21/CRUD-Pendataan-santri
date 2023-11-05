<?php

namespace Database\Seeders;

use App\Models\User;
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


        /**
         * User Roles
         * 
         * 1 = Admin Kampus 1, 
         * 2 = Admin Kampus 2, 
         * 3 = Admin Kampus 3
         * 4 = Admin Kampus 4,
         * 0 = Administrator
         */

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'Kampus 1',
                'email' => 'adminkampus1@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 1
            ],
            [
                'name' => 'Kampus 2',
                'email' => 'adminkampus2@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 2
            ],
            [
                'name' => 'Kampus 3',
                'email' => 'adminkampus3@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 3
            ],
            [
                'name' => 'Kampus 4',
                'email' => 'adminkampus4@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 4
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
