<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Author',
                'email' => 'seriiburduja@mail.ru',
                'password' => bcrypt('serii1981;'),
                'status' => 'active',
                'role' => 'user'
            ],
            [
                'name' => 'Admin',
                'email' => 'seriiburduja@gmail.com',
                'password' => bcrypt('serii1981;'),
                'status' => 'active',
                'role' => 'admin'
            ]
        ];

        DB::table('users')->insert($users);
    }
}
