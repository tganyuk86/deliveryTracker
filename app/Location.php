<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Location extends Model
{
    protected $fillable = [
        'name', 'lat', 'lon', 'value', 'order', 'called_at'
    ];

}
