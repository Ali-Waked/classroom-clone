<?php

namespace App\Models;

use App\Concerns\HasPrice;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plan extends Model
{
    use HasFactory,HasPrice;
    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'plan_feature')->withPivot(['feature_value']);
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'subscriptions');
    }
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($price) => $price / 100,
            set: fn ($price) => $price * 100,
        );
    }
}
