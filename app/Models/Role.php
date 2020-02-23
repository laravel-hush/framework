<?php

namespace ScaryLayer\Hush\Models;

use Illuminate\Database\Eloquent\Model;
use ScaryLayer\Hush\Traits\Translatable;

class Role extends Model
{
    use Translatable;

    protected $table = 'roles';
    protected $fillable = ['key'];

    protected $translatable_table = 'role_translations';
    protected $translatable_related = 'role_id';
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
