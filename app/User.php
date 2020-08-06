<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ultraware\Roles\Traits\HasRoleAndPermission;
use Ultraware\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class User extends Authenticatable implements  HasRoleAndPermissionContract
{
    use Notifiable,HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'avatar','email', 'password','is_activated','api_token','mobile_number','address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }
    public function orderItem()
    {
        return $this->belongsTo('App\Models\OrderItem');
    }
}
