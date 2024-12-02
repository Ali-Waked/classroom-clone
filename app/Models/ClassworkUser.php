<?php

namespace App\Models;

use App\Enums\ClassworkUserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassworkUser extends Pivot
{
    use HasFactory;
    protected $casts = [
        'status' => ClassworkUserStatus::class,
    ];
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
    public function getUpdatedAtColumn() {
        return;
    }
}
