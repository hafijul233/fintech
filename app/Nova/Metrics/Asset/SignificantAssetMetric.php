<?php

namespace App\Nova\Metrics\Asset;

use App\Models\Asset;
use App\Models\Chart;
use App\Supports\Constant;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;

class SignificantAssetMetric extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  NovaRequest  $request
     * @return PartitionResult
     */
    public function calculate(NovaRequest $request)
    {
        $charts = Chart::enabled()->filtered(['account_id' => Constant::AC_ASSET])
            ->get()->pluck('name', 'id')->toArray();

        $query = Asset::whereHas('chart', function ($query) {
            return $query->where('account_id', '=', Constant::AC_ASSET);
        });

        return $this->sum($request, $query, 'amount', 'chart_id')
            ->label(fn ($value) => $charts[$value] ?? 'None');
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'asset-significant-asset-metric';
    }
}
