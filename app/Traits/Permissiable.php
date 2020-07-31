<?php

namespace ScaryLayer\Hush\Traits;

use ScaryLayer\Hush\Models\Role;

trait Permissiable
{
    public function roleObject()
    {
        return $this->hasOne(Role::class, 'key', 'role');
    }

    /**
     * Check if model is permitted for some action.
     *
     * @param string $permissionKey
     * @return bool
     */
    public function permitted(string $permissionKey): bool
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
