<?php

namespace ScaryLayer\Hush\Models;

use Illuminate\Database\Eloquent\Model;
use ScaryLayer\Hush\Traits\Translatable;

class Role extends Model
{
    use Translatable;

    protected $table = 'roles';
    protected $fillable = ['key'];
    protected $translatable = ['name'];

    public function permissions()
    {
        return $this->hasMany(RolePermission::class, 'role', 'key');
    }

    /**
     * Give new permission for the role
     *
     * @param string $permissionKey
     * @return void
     */
    public function givePermission(string $permissionKey): void
    {
        $this->permissions()->firstOrCreate(['permission' => $permissionKey]);
    }
}
