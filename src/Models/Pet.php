<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Model;
use Rpg\Contract\PetContract;
use Rpg;

class Pet extends Model implements PetContract
{
    protected $fillable = [
        'name',
        'experience',
        'monster_id'
    ];

    public function player()
    {
        return $this->belongsTo(Rpg::modeClass('Player'));
    }

    public function monster()
    {
        return $this->belongsTo(Rpg::class('Monster'));
    }

    public function getMonsterTypeIdAttribute()
    {
        return $this->monster->monster_type_id;
    }
}
