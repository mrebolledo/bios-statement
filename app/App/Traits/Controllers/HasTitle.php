<?php

namespace App\App\Traits\Controllers;

use Illuminate\Support\Str;

trait HasTitle
{
    public $title;

    protected function makeTitle()
    {
        return ucwords(str_replace('_','',$this->title ?? $this->getEntityName()));
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
}
