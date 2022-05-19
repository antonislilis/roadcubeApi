<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'roles';

    protected $casts = [
        'permissions' => 'json',
    ];

    protected $fillable = [
        'role', 'permissions'
    ];

    public function users()
    {

        return $this->hasMany('App\User', 'role_id', 'id');
    }

}
