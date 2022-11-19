<?php

namespace App\Nova\Metrics\Expense;

use App\Models\Asset;
use App\Models\Chart;
use App\Models\Expense;
use App\Supports\Constant;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;

class SignificantExpenseMetric extends Partition
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
     * @param NovaRequest $request
     * @return PartitionResult
     */
    public function calculate(NovaRequest $request)
    {
        $charts = Chart::enabled()->filtered(['account_id' => Constant::AC_EXPENSE])
            ->get()->pluck('name', 'id')->toArray();

        return $this->sum($request, Expense::whereHas('chart', fn($query) => $query->where('account_id', '=', Constant::AC_EXPENSE)), 'amount', 'chart_id')
            ->label(fn($value) => $charts[$value] ?? 'None');
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'significant-expense-metric';
    }
}
