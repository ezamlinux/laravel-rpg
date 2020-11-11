<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rpg\Contract\ItemContract;
use Rpg;
use Laravel\Scout\Searchable;

class Item extends Model implements ItemContract
{
    use Searchable, HasFactory;

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'recipes' => $this->recipes->pluck('name')
        ];
    }

    protected static function newFactory()
    {
        return \Database\Factories\ItemFactory::new();
    }

    public function recipes()
    {
        return $this->hasManyThrough(Rpg::class('Recipe'), Rpg::class('Ingredient'), 'recipe_id', 'id');
    }
}
