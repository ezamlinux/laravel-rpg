<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Model;
use Rpg\Contract\MonsterContract;
use Rpg\Traits\HasInventory;
use Rpg;

class Monster extends Model implements MonsterContract
{
    use HasInventory;

    protected $fillable = [
        'name',
        'experience',
        'monster_type_id'
    ];

    public function monster_type()
    {
        return $this->belongsTo(Rpg::class('MonsterType'));
    }

    public function locations()
    {
        return $this->belongsToMany(Rpg::class('Location'));
    }

    public function pets()
    {
        return $this->hasMany(Rpg::class('Pet'));
    }
}
