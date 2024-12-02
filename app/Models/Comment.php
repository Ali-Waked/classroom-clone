<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'classwork_id',
        'commentable_id',
        'commentable_type',
        'content',
        'ip',
        'user_agent',
    ];
    protected static function booted(): void
    {
        static::creating(function (Comment $comment) {
            $comment->user_id = Auth::id();
        });
    }
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
