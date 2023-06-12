<?php

namespace App\Nova\Metrics\Revenue;

use App\Models\Revenue;
use App\Traits\TrendQueryTrait;
use App\Traits\UserConfigTrait;
use DateInterval;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;

class RevenuePerDayMetric extends Trend
{
    use TrendQueryTrait;
    use UserConfigTrait;

    /**
     * The width of the card (1/3, 2/3, 1/2, 1/4, 3/4, or full).
     *
     * @var string
     */
    public $width = '2/3';

    /**
     * The displayable name of the metric.
     *
     * @var string
     */
    public $name = 'Revenue/Day';

    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $currency = $this->userPrefer()->currency;

        return $this->sumByDays($request, Revenue::class, 'amount')
            ->prefix(config("fintech.currency.{$currency}.symbol"))
            ->suffix(config("fintech.currency.{$currency}.code"));
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return config('fintech.constants.trend_metric_range');
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

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'revenue-revenue-per-day';
    }
}
