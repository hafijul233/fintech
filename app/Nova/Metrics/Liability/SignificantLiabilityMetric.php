<?php

namespace App\Nova\Metrics\Liability;

use App\Models\Chart;
use App\Models\Liability;
use App\Supports\Constant;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;

class SignificantLiabilityMetric extends Partition
{
    /**
     * The displayable name of the metric.
     *
     * @var string
     */
    public $name = 'Liabilities';

    /**
     * Calculate the value of the metric.
     *
     * @return PartitionResult
     */
    public function calculate(NovaRequest $request)
    {
        $charts = Chart::enabled()->filtered(['account_id' => Constant::AC_LIABILITY])
            ->get()->pluck('name', 'id')->toArray();

        return $this->sum($request, Liability::whereHas('chart', fn ($query) => $query->where('account_id', '=', Constant::AC_LIABILITY)), 'amount', 'chart_id')
            ->label(fn ($value) => $charts[$value] ?? 'None');
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'significant-liability-metric';
    }
}
