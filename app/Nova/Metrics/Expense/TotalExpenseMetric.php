<?php

namespace App\Nova\Metrics\Expense;

use App\Models\Expense;
use DateInterval;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class TotalExpenseMetric extends Value
{
    /**
     * The displayable name of the metric.
     *
     * @var string
     */
    public $name = 'Expenses';

    /**
     * Calculate the value of the metric.
     *
     * @param  NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $currency = $request->user()->currency ?? 'USD';

        return $this->sum($request, Expense::class, 'amount', 'entry')
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
        return config('fintech.constants.value_metric_range');
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
