<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Report\AssetTableMetric;
use App\Nova\Metrics\Report\ExpenseTableMetric;
use App\Nova\Metrics\Report\IncomeStatementTableMetric;
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
            (new AssetTableMetric)->showBorders(true),
            (new ExpenseTableMetric)->showBorders(true),
            (new IncomeStatementTableMetric)->showBorders(true),
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
