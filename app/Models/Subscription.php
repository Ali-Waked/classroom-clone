<?php

namespace App\Models;

use App\Concerns\HasPrice;
use App\Enums\SubscriptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subscription extends Model
{
    use HasFactory,HasPrice;
    protected $fillable = [
        'plan_id',
        'user_id',
        'expires_at',
        'price',
        'status',
    ];
    protected $casts = [
        'expires_at' => 'datetime',
        'status' => SubscriptionStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
