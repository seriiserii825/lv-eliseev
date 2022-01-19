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
                'password' => bcrypt('serii1981;')
            ],
            [
                'name' => 'Admin',
                'email' => 'seriiburduja@gmail.com',
                'password' => bcrypt('serii1981;')
            ]
        ];

        DB::table('users')->insert($users);
    }
}
