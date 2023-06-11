<?php

namespace App\Models;

use App\Models\Scopes\OnlyUserScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\EloquentSortable\SortableTrait;

class Chart extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SortableTrait;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'enabled' => 'boolean',
    ];

    /**
     * The attributes that should be used in sorting.
     *
     * @var array<string, string>
     */
    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    /**
     * The "booted" method of the model.
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
     */
    public function scopeEnabled(Builder $query): Builder
    {
        return $query->where('enabled', '=', true);
    }

    /**
     * get the list of only enabled list
     */
    public function scopeFiltered(Builder $query, array $filters = []): Builder
    {
        if (! empty($filters['account_id'])) {
            $query->where('account_id', '=', $filters['account_id']);
        }

        return $query;
    }

    public static function dropdown(array $filters = [])
    {
        return self::enabled()
            ->filtered($filters)
            ->get()->pluck('name', 'id')
            ->toArray();
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
