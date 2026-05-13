<?php

namespace App\Facades;

use App\Services\SEOMeta;
use Illuminate\Support\Facades\Facade;

class Meta extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SEOMeta::class;
    }
}
