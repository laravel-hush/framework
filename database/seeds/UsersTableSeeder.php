<?php

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
        $data = [
            [
                'role' => 'dev',
                'name' => 'dev',
                'email' => 'dev@hush.com',
                'password' => 'password'
            ],
            [
                'role' => 'admin',
                'name' => 'admin',
                'email' => 'admin@hush.com',
                'password' => 'password'
            ],
            [
                'role' => 'user',
                'name' => 'user',
                'email' => 'user@hush.com',
                'password' => 'password'
            ],
        ];

        $userModel = config('hush.app.user.model');
        foreach ($data as $item) {
            $userModel::create($item);
        }
    }
}