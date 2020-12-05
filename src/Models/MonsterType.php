<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Model;
use Rpg\Contract\MonsterTypeContract;
use Rpg;

class MonsterType extends Model implements MonsterTypeContract
{
    public function monsters()
    {
        return $this->hasMany(Rpg::class('Monster'), 'monster_type_id');
    }
}
