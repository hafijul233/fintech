<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Asset\SignificantAssetMetric;
use Laravel\Nova\Dashboard;

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
            SignificantAssetMetric::make()
                ->width('1/2')
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
