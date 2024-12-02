<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Classroom;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TopicPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Classroom $classroom): bool
    {
        return $classroom->users()->wherePivot('user_id', $user->id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Classroom $classroom): bool
    {
        return $classroom->users()->where('id', $user->id)->wherePivot('role', UserRole::TEACHER->value)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function updateOrDelete(User $user, Classroom $classroom): bool
    {
        return $classroom->where('user_id', $user->id)->orWhereHas('topics', function (Builder $builder) use ($user) {
            $builder->where('user_id', $user->id);
        })->exists();
    }
}
