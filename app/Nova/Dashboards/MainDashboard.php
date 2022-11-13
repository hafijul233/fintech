<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Asset\TotalAsset;
use App\Nova\Metrics\Equity\TotalEquity;
use App\Nova\Metrics\Expense\TotalExpense;
use App\Nova\Metrics\Liability\TotalLiability;
use App\Nova\Metrics\Revenue\TotalRevenue;
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
            TotalAsset::make()
                ->refreshWhenActionsRun()
                ->refreshWhenFiltersChange(),
            TotalLiability::make()
                ->refreshWhenActionsRun()
                ->refreshWhenFiltersChange(),
            TotalEquity::make()
                ->refreshWhenActionsRun()
                ->refreshWhenFiltersChange(),
            TotalRevenue::make()
                ->refreshWhenActionsRun()
                ->refreshWhenFiltersChange(),
            TotalExpense::make()
                ->refreshWhenActionsRun()
                ->refreshWhenFiltersChange()
        ];
    }
}
