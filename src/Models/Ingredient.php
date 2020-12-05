<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Model;
use Rpg\Contract\IngredientContract;
use Rpg;

class Ingredient extends Model implements IngredientContract
{
    protected $fillable = [
        'recipe_id',
        'item_id',
        'quantity'
    ];

    public function recipe()
    {
        return $this->belongsTo(Rpg::class('Recipe'));
    }

    public function item()
    {
        return $this->belongsTo(Rpg::class('Item'));
    }
}
