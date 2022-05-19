<?php

namespace App\Models;

use App\Filters\StoreFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Log extends Model
{
    protected $table = 'logs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'time', 'ip','method','header', 'url', 'status_code', 'user_name', 'user_id'
    ];


}
