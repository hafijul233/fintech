<?php

namespace App\Nova\Metrics\Revenue;

use App\Models\Revenue;
use DateInterval;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class TotalRevenue extends Value
{
    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Revenues';
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->sum($request, Revenue::class, 'amount', 'entry');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            'TODAY' => __('Today'),
            'YESTERDAY' => __('Yesterday'),
            30 => __('30 Days'),
            60 => __('60 Days'),
            365 => __('365 Days'),
            'MTD' => __('Month To Date'),
            'QTD' => __('Quarter To Date'),
            'YTD' => __('Year To Date'),
        ];
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return DateTimeInterface|DateInterval|float|int|null
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }
}
