<?php

use Illuminate\Database\Seeder;
use ScaryLayer\Hush\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = config('hush.roles');
        foreach ($data as $key => $item) {
            $role = Role::create(['key' => $key]);
            $role->saveTranslation('name', $item['name']);

            if (isset($item['permissions'])) {
                foreach ($item['permissions'] as $permission) {
                    $role->givePermission($permission);
                }
            }
        }
    }
}
