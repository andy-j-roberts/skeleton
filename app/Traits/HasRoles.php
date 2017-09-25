<?php

namespace App\Traits;

use App\Role;

trait HasRoles
{
    public static function bootHasRoles()
    {
        static::deleting(function($model){
           $model->roles()->detach();
        });
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function assignRole($role)
    {
        $role = $this->getStoredRole($role);
        if($role)
        {
            $this->roles()->syncWithoutDetaching([$role->id]);
        }

        return $this;
    }

    public function removeRole($role)
    {
        $role = $this->getStoredRole($role);
        if($role)
        {
            $this->roles()->detach([$role->id]);
        }
    }

    protected function getStoredRole($role): Role
    {
        return Role::whereName($role)->first();
    }

    public function hasRole($roles)
    {
        if (is_string($roles)) {
            return $this->roles->contains('name', $roles);
        }

        if(is_array($roles))
        {
            return collect($roles)->filter(function($role){
                return $this->hasRole($role);
            })->isNotEmpty();
        }

        return $roles->intersect($this->roles)->isNotEmpty();
    }
}