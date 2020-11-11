<?php

namespace Rpg\Traits;

use Rpg;

trait HasInventory
{
    /**
     * Get the post's image.
     */
    public function inventories()
    {
        return $this->morphMany(Rpg::class('Inventory'), 'inventorable');
    }
}
