<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'permissions';


    protected $fillable = [
        'name', 'category', 'is_default'
    ];


}
