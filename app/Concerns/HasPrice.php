<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasPrice
{
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($price) => $price / 100,
            set: fn ($price) => $price * 100,
        );
    }
}
