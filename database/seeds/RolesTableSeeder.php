<?php

use Illuminate\Database\Seeder;
use ScaryLayer\Hush\Models\Role;

class RolesTableSeeder extends Seeder
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
                'key' => 'dev',
                'name' => [
                    'ru' => 'Разработчик',
                    'en' => 'Developer'
                ],
                'permissions' => ['god']
            ],
            [
                'key' => 'admin',
                'name' => [
                    'ru' => 'Администратор',
                    'en' => 'Administrator'
                ],
                'permissions' => ['admin']
            ],
            [
                'key' => 'user',
                'name' => [
                    'ru' => 'Пользователь',
                    'en' => 'User'
                ],
            ],
        ];

        foreach ($data as $item) {
            $role = Role::create(['key' => $item['key']]);
            $role->saveTranslation('name', $item['name']);

            if (isset($item['permissions'])) {
                foreach ($item['permissions'] as $permission) {
                    $role->givePermission($permission);
                }
            }
        }
    }
}
