<?php
/**
 * Created by PhpStorm.
 * User: Good One Sales
 * Date: 10/28/2018
 * Time: 9:16 PM
 */

namespace App\Traits;


trait UserPrivacyTrait
{

    public function do($permission){

        if (auth()->user()->role->hasPermission($permission))
            return true;

        return false;
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function getRole()
    {
        return (!$this->role) ? $this->getR('user') : $this->role;
    }

    public function getR($roleName = null)
    {
        return \App\Role::where('slug',$roleName)->first();
    }

    public function hasRole($role)
    {
        return $this->getRoles()->contains($this->getRole($role));
    }

    public function verified(){
        return ($this->hasOne('App\VerifyUser','user_id')->first() && $this->hasOne('App\VerifyUser','user_id')->first()->verified == 1) ? true : false;
    }
}
