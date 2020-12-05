<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rpg;
use Rpg\Contract\LocationContract;

class Location extends Model implements LocationContract
{
    use HasFactory;

    protected $fillable = [
        'name',
        'minimal_level',
        'parent_id',
        'location_type_id'
    ];

    protected static function newFactory()
    {
        return \Database\Factories\LocationFactory::new();
    }

    public function monsters()
    {
        return $this->belongsToMany(Rpg::class('Monster'));
    }

    public function players()
    {
        return $this->hasMany(Rpg::class('Player'));
    }

    public function parent()
    {
        return $this->belongsTo(Rpg::class('Location'));
    }

    public function childs()
    {
        return $this->hasMany(Rpg::class('Location'), 'parent_id');
    }

    public function location_type()
    {
        return $this->belongsTo(Rpg::class('LocationType'));
    }
}
