<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Asset\AssetPerDayMetric;
use App\Nova\Metrics\Expense\ExpensePerDayMetric;
use App\Nova\Metrics\Liability\LiabilityPerDayMetric;
use App\Nova\Metrics\Revenue\RevenuePerDayMetric;
use Formfeed\Breadcrumbs\Breadcrumbs;
use Laravel\Nova\Dashboard;
use Laravel\Nova\Http\Requests\NovaRequest;

class HistogramDashboard extends Dashboard
{
    /**
     * The displayable name of the dashboard.
     *
     * @return string
     */
    public function name()
    {
        return 'Histogram';
    }

    /**
     * Get the URI key of the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'histograms';
    }

    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            Breadcrumbs::make(app(NovaRequest::class), $this),
            AssetPerDayMetric::make()
                ->width('full'),
            LiabilityPerDayMetric::make()
                ->width('full'),
            RevenuePerDayMetric::make()
                ->width('full'),
            ExpensePerDayMetric::make()
                ->width('full'),
        ];
    }
}
