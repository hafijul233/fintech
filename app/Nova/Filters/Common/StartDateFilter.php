<?php

namespace App\Nova\Filters\Common;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

class StartDateFilter extends DateFilter
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Start Date';

    /**
     * Apply the filter to the given query.
     *
     * @param NovaRequest $request
     * @param Builder $query
     * @param mixed $value
     * @return Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        $value = Carbon::parse($value)->format('Y-m-d');

        return $query->where('entry', '>=', $value);
    }
}
