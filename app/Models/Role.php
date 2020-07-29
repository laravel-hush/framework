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

    public function givePermission($permissionKey)
    {
        $this->permissions()->firstOrCreate(['permission' => $permissionKey]);
    }
}
