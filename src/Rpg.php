<?php

namespace Rpg;

use Illuminate\Support\Str;

class Rpg
{
    public function __construct()
    {
        $this->setModels(config('rpg.models', []));
    }

    /**
     * @var array
     */
    public $models = [];

    public function setModels(array $models) : void
    {
        foreach ($models as $alias => $model) {
            $this->models[$alias] = $model;
        }
    }

    public function getModels() : array
    {
        return $this->models;
    }

    public function model(string $name)
    {
        return app($this->models[Str::studly($name)]);
    }

    public function class($name) : string
    {
        return $this->models[$name];
    }
}
