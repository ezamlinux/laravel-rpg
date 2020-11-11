<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rpg;
use Rpg\Contract\TitleContract;

class Title extends Model implements TitleContract
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected static function newFactory()
    {
        return \Database\Factories\TitleFactory::new();
    }

    public function players()
    {
        return $this->hasMany(Rpg::class('Player'));
    }
}
