<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    const ACTIVE = 1;

    protected $fillable = [
        'name',
        'description'
    ];
}
