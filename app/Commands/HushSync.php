<?php

namespace ScaryLayer\Hush\Commands;

use Illuminate\Console\Command;
use ScaryLayer\Hush\Models\Role;

class HushSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hush:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncs new roles and permissions with database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $roles = collect(config('hush.roles'));
        Role::whereNotIn('key', $roles->keys()->all())->delete();
        foreach ($roles as $key => $role) {
            $roleObject = Role::firstOrCreate(['key' => $key]);
            $roleObject->saveTranslation('name', $role['name']);

            if (isset($role['permissions'])) {
                $roleObject->permissions()
                    ->whereNotIn('permission', $role['permissions'])
                    ->delete();
                $newPermissions = collect($role['permissions'])
                    ->filter(function ($item) use ($roleObject) {
                        return !in_array($item, $roleObject->permissions->pluck('permission')->all());
                    });
                foreach ($newPermissions as $permission) {
                    $roleObject->permissions()->create(['permission' => $permission]);
                }
            }

        }
    }
}
