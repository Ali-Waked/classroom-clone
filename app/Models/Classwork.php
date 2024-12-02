<?php

namespace App\Models;

use App\Enums\ClassworkStatus;
use App\Enums\ClassworkType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

class Classwork extends Model
{
    use HasFactory;
    protected $fillable = [
        'classroom_id',
        'user_id',
        'topic_id',
        'title',
        'description',
        'type',
        'status',
        'published_at',
        'options',
    ];

    protected $casts = [
        'options' => 'json',
        'status' => ClassworkStatus::class,
        'type' => ClassworkType::class,
    ];
    public function getUpdatedAtColumn()
    {
    }
    protected static function booted(): void
    {
        static::creating(function (Classwork $classwork) {
            $classwork->user_id = Auth::id();
        });
    }
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'classwork_user')->withPivot(['grade', 'status', 'submitted_at', 'created_at'])->using(ClassworkUser::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class, 'classwork_id');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status == ClassworkStatus::PUBLISHED,
        );
    }
}
