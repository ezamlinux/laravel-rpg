<?php

namespace Rpg\Contract;

interface InventoryContract
{
    public function inventorable();

    public function items();

    public function inventory_type();
}
