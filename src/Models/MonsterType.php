<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rpg;

class MonsterType extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Database\Factories\MonsterTypeFactory::new();
    }

    public function monsters()
    {
        return $this->hasMany(Rpg::class('Monster'), 'monster_type_id');
    }
}
