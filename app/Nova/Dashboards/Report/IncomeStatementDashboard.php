<?php

namespace App\Nova\Dashboards\Report;

use App\Nova\Metrics\Report\RevenueTableMetric;
use Laravel\Nova\Dashboard;

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
