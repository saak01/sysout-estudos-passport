<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;
    use HasFactory;

    function routes() {
        return $this->belongsToMany(Route::class, 'group_route', 'group_id', 'route_id');
        // this->hasOne()
    }

}
