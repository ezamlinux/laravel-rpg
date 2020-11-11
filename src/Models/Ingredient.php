<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Model;
use Rpg;

class Ingredient extends Model
{
    public function recipe()
    {
        return $this->belongsTo(Rpg::class('Recipe'));
    }

    public function item()
    {
        return $this->belongsTo(Rpg::class('Item'));
    }
}
