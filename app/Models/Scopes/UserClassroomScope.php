<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserClassroomScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->whereExists(function(QueryBuilder $builder){
            $builder->select(DB::raw('1'))
            ->from('classroom_user')
            ->whereColumn('classroom_id','classrooms.id')
            ->where('user_id',Auth::id());
        });
        
    }
}
