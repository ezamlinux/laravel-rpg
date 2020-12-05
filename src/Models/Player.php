<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Model;
use Rpg;
use Rpg\Contract\PlayerContract;
use Rpg\Traits\HasInventory;
use Laravel\Scout\Searchable;

class Player extends Model implements PlayerContract
{
    use HasInventory, Searchable;

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
