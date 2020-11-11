<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rpg;
use Rpg\Contract\PlayerContract;
use Rpg\Traits\HasInventory;
use Laravel\Scout\Searchable;

class Player extends Model implements PlayerContract
{
    use HasFactory, HasInventory, Searchable;

    protected $fillable = [
        'name',
        'discord_id',
        'biography',
        'title_id',
        'experience',
        'level'
    ];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'title' => optional($this->title)->name
        ];
    }

    protected static function newFactory()
    {
        return \Database\Factories\PlayerFactory::new();
    }

    public function title()
    {
        return $this->belongsTo(Rpg::class('Title'));
    }

    public function pets()
    {
        return $this->hasMany(Rpg::class('Pet'));
    }

    public function location()
    {
        return $this->belongsTo(Rpg::class('Location'));
    }

    public function user()
    {
        return $this->belongsTo(Rpg::class('User'));
    }
}
