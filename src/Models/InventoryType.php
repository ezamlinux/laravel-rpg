<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Model;
use Rpg\Contract\InventoryTypeContract;
use Rpg;
use Rpg\Traits\HasInventory;

class InventoryType extends Model implements InventoryTypeContract
{
    use HasInventory;

    public $fillable = [
        'capacity',
        'name'
    ];

    public function inventories()
    {
        return $this->hasMany(Rpg::class('Inventory'));
    }
}
