<?php

namespace App\Models;

use App\Filters\StoreFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';
    protected $primaryKey = 'store_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'store_type_id', 'name', 'app_name', 'address', 'zip', 'email', 'lat', 'lon'
    ];

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new StoreFilter($request))->filter($builder);
    }

}
