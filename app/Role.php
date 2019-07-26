<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany('App\Permission','permission_role');
    }

    public function getPermissions()
    {
        return (!$this->permissions) ? $this->permissions()->get() : $this->permissions;
    }

    public function getPermission($permissionName = null)
    {
        return \App\Permission::where('name',$permissionName)->first();
    }

    public function hasPermission($permission)
    {
        return $this->getPermissions()->contains($this->getPermission($permission));

    }

    public function attachPermission($permission)
    {
        return (!$this->getPermissions()->contains($permission)) ? $this->permissions()->attach($permission) : true;
    }

    public function detachPermission($permission)
    {
        $this->permissions = null;
        $this->permissions()->detach($permission);
    }

    public function detachAllPermissions()
    {
        $this->permissions = null;
        $this->permissions()->detach();
    }

}
