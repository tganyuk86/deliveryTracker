<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    protected $fillable = [
        'name', 'lat', 'lon', 'notes', 'phone', 'status', 'address'
    ];
}
