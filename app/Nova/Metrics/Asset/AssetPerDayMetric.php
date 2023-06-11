<?php

namespace App\Nova\Metrics\Asset;

use App\Models\Asset;
use App\Traits\TrendQueryTrait;
use DateInterval;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;

class AssetPerDayMetric extends Trend
{
    use TrendQueryTrait;

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
    public $name = 'Assets/Day';

    /**
     * Calculate the value of the metric.
     *
     * @param  NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $currency = config('app.currency', 'USD');

        return $this->sumByDays($request, Asset::class, 'amount', 'entry')
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
        return 'asset-asset-per-day';
    }
}
