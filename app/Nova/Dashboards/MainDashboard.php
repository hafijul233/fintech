<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Asset\TotalAssetMetric;
use App\Nova\Metrics\Equity\TotalEquityMetric;
use App\Nova\Metrics\Expense\TotalExpenseMetric;
use App\Nova\Metrics\Liability\TotalLiabilityMetric;
use App\Nova\Metrics\OverallAmountMetric;
use App\Nova\Metrics\Revenue\TotalRevenueMetric;
use Formfeed\Breadcrumbs\Breadcrumbs;
use Laravel\Nova\Dashboards\Main as Dashboard;
use Laravel\Nova\Http\Requests\NovaRequest;

class MainDashboard extends Dashboard
{
    /**
     * The displayable name of the dashboard.
     *
     * @return string
     */
    public function name()
    {
        return 'Dashboard';
    }

    /**
     * Get the URI key of the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'main';
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
            OverallAmountMetric::make(),
            TotalAssetMetric::make(),
            TotalLiabilityMetric::make(),
            TotalEquityMetric::make(),
            TotalRevenueMetric::make(),
            TotalExpenseMetric::make(),
        ];
    }
}
