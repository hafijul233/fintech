<?php

namespace App\Models;

use App\Models\Scopes\OnlyUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Liability extends Model implements Auditable, HasMedia
{
    use \OwenIt\Auditing\Auditable;
    use InteractsWithMedia;

    /**
     * Register profile Image Media Collection
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments')
            ->useDisk('attachments');
    }

    protected $casts = [
        'entry' => 'date',
        'amount' => 'float',
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
