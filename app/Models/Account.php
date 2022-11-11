<?php

namespace App\Models;

use App\Models\Scopes\EnabledScope;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
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
        static::addGlobalScope(new EnabledScope);
    }
}
