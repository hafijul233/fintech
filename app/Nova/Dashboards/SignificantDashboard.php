<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Asset\SignificantAssetMetric;
use App\Nova\Metrics\Equity\SignificantEquityMetric;
use App\Nova\Metrics\Expense\SignificantExpenseMetric;
use Formfeed\Breadcrumbs\Breadcrumbs;
use Laravel\Nova\Dashboard;
use Laravel\Nova\Http\Requests\NovaRequest;

class SignificantDashboard extends Dashboard
{
    /**
     * The displayable name of the dashboard.
     *
     * @return string
     */
    public function name()
    {
        return 'Signification';
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

            SignificantAssetMetric::make()
                ->width('1/2'),

            SignificantEquityMetric::make()
                ->width('1/2'),

            SignificantExpenseMetric::make()
                ->width('1/2'),
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'significant';
    }
}
