<?php

namespace ScaryLayer\Hush\Traits;

use ScaryLayer\Hush\Models\Role;

trait Permissiable
{
    public function roleObject()
    {
        return $this->hasOne(Role::class, 'key', 'role');
    }

    public function permitted($permissionKey)
    {
        $permissions = is_string($permissionKey)
            ? ['god', $permissionKey]
            : collect($permissionKey)->push('god')->all();

        return (bool) $this->roleObject
            ->permissions()
            ->whereIn('permission', $permissions)
            ->first();
    }
}
