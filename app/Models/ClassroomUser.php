<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;

class ClassroomUser extends Pivot
{
    use HasFactory;
    protected $table = 'classroom_user';
    protected $fillable = [
        'classroom_id', 'user_id', 'role', 'created_at',
    ];
    protected static function booted(): void
    {
        static::creating(function (ClassroomUser $classroomUser) {
            $classroomUser->user_id = Auth::id();
        });
    }
    public function getUpdatedAtColumn()
    {
    }
    public function scopeTeachers(Builder $builder): void
    {
        $builder->where('user_id', Auth::id())->where('role', UserRole::TEACHER->value);
    }
    public function scopeStudents(Builder $builder): void
    {
        $builder->where('user_id', Auth::id())->where('role', UserRole::STUDENT->value);
    }
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }
    // public function getUpdatedAtColumn()
    // {
    //     return $this;
    // }

}
