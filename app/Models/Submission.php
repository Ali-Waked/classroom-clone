<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    use HasFactory;
    protected $fillable = [
        'classwork_id', 
        'user_id', 
        'content',
        'type',
    ];
    public function classwork(): BelongsTo
    {
        return $this->belongsTo(Classwork::class);
    }
    public function getUpdatedAtColumn()
    {
        return '';
    }
}
