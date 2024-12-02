<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'classroom_id',
    ];
    protected static function booted()
    {
        static::creating(function (Topic $topic) {
            $topic->user_id = Auth::id();
        });
    }
    public function classworks(): HasMany
    {
        return $this->hasMany(Classwork::class);
    }
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }
}
