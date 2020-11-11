<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Model;
use Rpg;
use Rpg\Contract\RecipeContract;
use Laravel\Scout\Searchable;

class Recipe extends Model implements RecipeContract
{
    use Searchable;

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'items' => $this->load('ingredients.item')->pluck('name')->implode('name')
        ];
    }

    public function ingredients()
    {
        return $this->hasMany(Rpg::class('Ingredient'));
    }

    public function result()
    {
        return $this->belongsTo(Rpg::class('Item'));
    }
}
