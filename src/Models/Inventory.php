<?php

namespace Rpg\Models;

use Illuminate\Database\Eloquent\Model;
use Rpg\Contract\InventoryContract;
use Rpg;

class Inventory extends Model implements InventoryContract
{
    public $fillable = [
        'inventory_type_id',
        'name'
    ];

    public function inventorable()
    {
        return $this->morphTo(__FUNCTION__);
    }

    public function items()
    {
        return $this->belongsToMany(Rpg::class('Item'));
    }

    public function inventory_type()
    {
        return $this->belongsTo(Rpg::class('InventoryType'));
    }
}
