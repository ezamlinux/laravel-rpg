<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Model;
use Rpg;
use Rpg\Contract\TitleContract;

class Title extends Model implements TitleContract
{
    protected $fillable = [
        'name'
    ];

    public function players()
    {
        return $this->hasMany(Rpg::class('Player'));
    }
}
