<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Model;
use Rpg;

class MonsterType extends Model
{
    public function monsters()
    {
        return $this->hasMany(Rpg::class('Monster'), 'monster_type_id');
    }
}
