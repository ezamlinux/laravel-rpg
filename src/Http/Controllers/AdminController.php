<?php

namespace Rpg\Http\Controllers;

use Rpg\Contract\PlayerContract;
use Rpg\Models\Player;

class AdminController extends \Rpg\Http\Controllers\Controller
{
    public function __invoke()
    {
        return view('rpg::dashboard');
    }
    /**
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function pdf(PlayerContract $player)
    {
        return view('rpg::pdf.player', ['model' => $player]);
    }
}
