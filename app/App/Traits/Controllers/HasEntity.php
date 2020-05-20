<?php

namespace App\App\Traits\Controllers;

use Illuminate\Support\Str;

trait HasEntity
{
    public $entity;

    public abstract function entity();

    protected function resolveEntity()
    {
        if(!method_exists($this,'entity')) {
            throw new \Exception('No entity defined');
        }

        return app()->make($this->entity());
    }

    protected function getEntityName()
    {
        return Str::slug($this->entity->getTable(),'-');
    }
}
