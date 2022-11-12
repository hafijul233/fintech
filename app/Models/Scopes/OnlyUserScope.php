<?php

namespace App\Models\Scopes;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OnlyUserScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        if ($model instanceof User) {
            $builder->where($model->getTable() . '.id', "=", request()->user()->id);
        }

        if (auth()->user()) {
            $builder->where($model->getTable() . '.user_id', "=", request()->user()->id);
        }
    }
}
