<?php

namespace Rpg\Http\Controllers;

class AdminController extends \Rpg\Http\Controllers\Controller
{
    public function __invoke()
    {
        return view('rpg::dashboard');
    }
}
