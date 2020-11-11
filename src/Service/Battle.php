<?php

namespace Rpg\Service;

class Battle
{
    public function xp($monster, ?int $level = null) : int
    {
        $level = ($level ?: $monster->level) + 1;

        switch ($monster->monster_type_id) {
            case 1:
                return 0.8 * pow($level, 3);
                break;
            case 2:
                return pow($level, 3);
                break;
            case 3:
                return 1.2 * pow($level, 3) - 15 * pow($level, 3) + (100 * $level) - 140;
                break;
            case 4:
                return 1.25 * pow($level, 3);
                break;
        }
    }
}
