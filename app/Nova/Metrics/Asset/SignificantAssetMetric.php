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
     * @param NovaRequest $request
     * @return PartitionResult
     */
    public function calculate(NovaRequest $request)
    {
        $charts = Chart::enabled()
            //->filtered(['account_id' => Constant::AC_ASSET])
            ->get()
            ->toArray();

        $query = Asset::whereHas('chart', function ($query) {
            return $query->where('account_id', '=', Constant::AC_ASSET);
        })->limit(10);

        $return = $this->sum($request, $query, 'amount', 'chart_id');
        dd($charts);
//            ->label(fn($value) => $charts[$value] ?? 'None');


        return $return;
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
