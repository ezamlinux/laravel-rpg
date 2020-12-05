<?php

namespace Rpg\Contract;

interface LocationContract
{
    public function monsters();

    public function players();

    public function parent();

    public function childs();

    public function location_type();
}
