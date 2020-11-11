<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Model;
use Rpg;
use Rpg\Contract\LocationTypeContract;

class LocationType extends Model implements LocationTypeContract
{
    protected $fillable = [
        'name',
    ];

    public function locations()
    {
        return $this->hasMany(Rpg::class('Location'));
    }
}
