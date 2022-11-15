<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Asset\AssetPerDayMetric;
use App\Nova\Metrics\Equity\EquityPerDayMetric;
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
     * Determines whether Nova should show a refresh button.
     *
     * @var bool
     */
    public $showRefreshButton = true;

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
                ->width('full')
                ->refreshWhenActionsRun()
                ->refreshWhenFiltersChange(),
            LiabilityPerDayMetric::make()
                ->width('full')
                ->refreshWhenActionsRun()
                ->refreshWhenFiltersChange(),
            EquityPerDayMetric::make()
                ->width('full')
                ->refreshWhenActionsRun()
                ->refreshWhenFiltersChange(),
            RevenuePerDayMetric::make()
                ->width('full')
                ->refreshWhenActionsRun()
                ->refreshWhenFiltersChange(),
            ExpensePerDayMetric::make()
                ->width('full')
                ->refreshWhenActionsRun()
                ->refreshWhenFiltersChange(),
        ];
    }
}
