<?php

namespace App\Models;

use App\Models\Scopes\OnlyUserScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Chart extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'enabled' => 'boolean',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new OnlyUserScope);

        static::creating(function (Chart $chart) {
            if (auth()->user()) {
                $chart->user_id = $chart->user_id ?? request()->user()->id;
                $chart->getDirty();
            }
        });
    }

    /**
     * get the list of only enabled list
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeEnabled(Builder $query): Builder
    {
        return $query->where('enabled', "=", true);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }

    public function liabilities(): HasMany
    {
        return $this->hasMany(Liability::class);
    }

    public function equities(): HasMany
    {
        return $this->hasMany(Equity::class);
    }

    public function revenues(): HasMany
    {
        return $this->hasMany(Revenue::class);
    }


    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }


}
