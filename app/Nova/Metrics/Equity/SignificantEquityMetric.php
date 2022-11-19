<?php

namespace App\Nova\Metrics\Equity;

use App\Models\Asset;
use App\Models\Chart;
use App\Models\Equity;
use App\Supports\Constant;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;

class SignificantEquityMetric extends Partition
{

    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     * @return PartitionResult
     */
    public function calculate(NovaRequest $request)
    {
        $charts = Chart::enabled()->filtered(['account_id' => Constant::AC_EQUITY])
            ->get()->pluck('name', 'id')->toArray();

        return $this->sum($request, Equity::whereHas('chart', fn($query) => $query->where('account_id', '=', Constant::AC_EQUITY)), 'amount', 'chart_id')
            ->label(fn($value) => $charts[$value] ?? 'None');
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'significant-equity-metric';
    }
}
