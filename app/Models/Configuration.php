<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

class Configuration extends Model implements Auditable
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
        //static::addGlobalScope(new OnlyUserScope);

        static::creating(function (Configuration $setting) {
            $setting->user_id = request()->user()->id ?? null;
            $setting->name = strtolower(str_replace([' '], '_', $setting->name));
            $setting->getDirty();
        });
    }

    /**
     * get the list of only enabled list
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeEnabled(Builder $query): Builder
    {
        return $query->where('enabled', '=', true);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
