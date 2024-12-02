<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ClassworkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(User $user): bool
    // {
    //     if()
    // }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Classroom $classroom): bool
    {
        return $classroom->users()->where([
            'id' => $user->id,
            'role' => UserRole::TEACHER->value
        ])->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Classroom $classroom): bool
    {
        return $classroom->users()->where([
            'id' => $user->id,
            'role' => UserRole::TEACHER->value
        ])->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Classwork $classwork): bool
    {
        return  $classwork->where('user_id', Auth::id())->orWhereHas('classroom', function (Builder $query) {
            $query->where('user_id', Auth::id());
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Classwork $classwork): bool
    {
        return  $classwork->where('user_id', Auth::id())->orWhereHas('classroom', function (Builder $query) {
            $query->where('user_id', Auth::id());
        })->exists();
    }
}
