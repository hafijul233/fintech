<?php

namespace App\Nova\Metrics;

use App\Models\Asset;
use App\Models\Equity;
use App\Models\Expense;
use App\Models\Liability;
use App\Models\Revenue;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class OverallAmountMetric extends Value
{
    /**
     * The displayable name of the metric.
     *
     * @var string
     */
    public $name = 'Overall Amount';

    /**
     * Rounding precision.
     *
     * @var int
     */
    public $roundingPrecision = 2;

    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $currency = config('app.currency', 'USD');

        $assets = $this->sum($request, Asset::class, 'amount', 'entry');

        $liabilities = $this->sum($request, Liability::class, 'amount', 'entry');

        $equities = $this->sum($request, Equity::class, 'amount', 'entry');

        $revenues = $this->sum($request, Revenue::class, 'amount', 'entry');

        $expenses = $this->sum($request, Expense::class, 'amount', 'entry');

        $totalCurrentBalance = ($assets->value - ($liabilities->value + $equities->value + ($revenues->value - $expenses->value)));

        $totalPreviousBalance = ($assets->previous - ($liabilities->previous + $equities->previous + ($revenues->previous - $expenses->previous)));

        return $this->result(
            round(
                $totalCurrentBalance,
                $this->roundingPrecision,
                $this->roundingMode
            )
        )->prefix(config("fintech.currency.{$currency}.symbol"))
            ->suffix(config("fintech.currency.{$currency}.code"))
            ->previous($totalPreviousBalance);
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
            7 => __('7 Days'),
            15 => __('15 Days'),
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
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }
}
