<?php

$this->router->get('/', 'AdminController');

$this->router->get('players/{player}/pdf', 'AdminController@pdf');
