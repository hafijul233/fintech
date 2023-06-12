<?php

namespace App\Traits;

use Laravel\Nova\Http\Requests\NovaRequest;

trait UserConfigTrait
{
    public function userPrefer()
    {
        return app(NovaRequest::class)->user();
    }
}
