<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
                'name' => 'dev',
                'email' => 'dev@hush.com',
                'password' => 'password',
                'role' => 'dev',
            ],
            [
                'name' => 'admin',
                'email' => 'admin@hush.com',
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'user',
                'email' => 'user@hush.com',
                'password' => 'password',
                'role' => 'user',
            ],
        ];

        $userModel = config('hush.app.user.model');
        foreach ($data as $item) {
            $item['password'] = bcrypt($item['password']);
            $userModel::create($item);
        }
    }
}
