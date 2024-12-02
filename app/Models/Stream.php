<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stream extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'classroom_id', 'user_id', 'content', 'link',
    ];
    
    public function getUpdatedAtColumn()
    {
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function Classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }
}
