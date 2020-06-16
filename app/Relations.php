<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relations extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'service_id',
        'active_service'
    ];
}
