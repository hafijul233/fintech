<?php

namespace App\Nova\Dashboards\Report;

use App\Nova\Metrics\Report\RevenueTableMetric;
use Formfeed\Breadcrumbs\Breadcrumbs;
use Laravel\Nova\Dashboard;
use Laravel\Nova\Http\Requests\NovaRequest;

class IncomeStatementDashboard extends Dashboard
{
    /**
     * The displayable name of the dashboard.
     *
     * @var string
     */
    public $name = 'Income Statement';

    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            Breadcrumbs::make(app(NovaRequest::class), $this),

            (new RevenueTableMetric)->refreshWhenFiltersChange(),
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'income-statement';
    }
}
