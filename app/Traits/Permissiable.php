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
        return (bool) $this->roleObject
            ->permissions()
            ->whereIn('permission', ['god', $permissionKey])
            ->first();
    }
}
