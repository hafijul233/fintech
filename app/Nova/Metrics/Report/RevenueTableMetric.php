<?php

namespace App\Nova\Metrics\Report;

use App\Models\Revenue;
use App\Supports\Constant;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

class RevenueTableMetric extends Table
{
    /**
     * The width of the card (1/3, 2/3, 1/2, 1/4, 3/4, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * The displayable name of the metric.
     *
     * @var string
     */
    public $name = 'Total Revenues';

    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $rows = [];

        Revenue::selectRaw("charts.name, count(revenues.amount) as aggregate")
            ->tap(fn($query) => $this->applyFilterQuery($request, $query))
            ->join('charts', 'charts.id', '=', 'revenues.chart_id')
            ->where('charts.account_id', '=', Constant::AC_REVENUE)
            ->where('charts.enabled', '=', true)
            ->groupBy('revenues.chart_id')
            ->each(function ($revenue) use (&$rows) {
                $rows[] = MetricTableRow::make()
                    ->icon('check-circle')
                    ->iconClass('text-green-500')
                    ->title($revenue->name)
                    ->subtitle('In every part of the globe it is the same!');
            });

        return $rows;
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
