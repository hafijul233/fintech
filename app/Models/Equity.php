<?php

namespace App\Models;

use App\Models\Scopes\OnlyUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equity extends Model
{
    protected $casts = [
        'entry' => 'date',
        'amount' => 'float'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new OnlyUserScope);

        static::creating(function (Asset $model) {
            if (auth()->user()) {
                $model->user_id = $model->user_id ?? request()->user()->id;
                $model->getDirty();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function chart(): BelongsTo
    {
        return $this->belongsTo(Chart::class);
    }
}
