<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function hasRelations($id, $relation_id): bool
    {
        $relations = Relations::whereServiceId($id)->whereActiveService($relation_id)->first();
        if(!empty($relations)) {
            return true;
        }

        return false;
    }

    public function relations()
    {
        return $this->hasMany(Relations::class, 'service_id', 'id');
    }
}
