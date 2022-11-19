<?php

namespace App\Nova\Metrics\Revenue;

use App\Models\Chart;
use App\Models\Revenue;
use App\Supports\Constant;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;

class SignificantRevenueMetric extends Partition
{
    /**
     * The displayable name of the metric.
     *
     * @var string
     */
    public $name = 'Revenues';

    /**
     * Calculate the value of the metric.
     *
     * @param  NovaRequest  $request
     * @return PartitionResult
     */
    public function calculate(NovaRequest $request)
    {
        $charts = Chart::enabled()->filtered(['account_id' => Constant::AC_REVENUE])
            ->get()->pluck('name', 'id')->toArray();

        return $this->sum($request, Revenue::whereHas('chart', fn ($query) => $query->where('account_id', '=', Constant::AC_REVENUE)), 'amount', 'chart_id')
            ->label(fn ($value) => $charts[$value] ?? 'None');
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'significant-revenue-metric';
    }
}
