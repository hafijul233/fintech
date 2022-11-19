<?php

namespace App\Nova\Metrics\Report;

use App\Models\Revenue;
use App\Supports\Constant;
use JoeriTheGreat\TableCard\Table\Cell;
use JoeriTheGreat\TableCard\Table\Row;
use JoeriTheGreat\TableCard\TableCard;

class RevenueTableMetric extends TableCard
{
    public function __construct(array $header = [], array $data = [], string $title = '', bool $viewAll = false)
    {
        parent::__construct($header, $data, $title, $viewAll);

        $headers = [
            Cell::make('Name')->class('font-bold'),
            Cell::make('Amount')
                ->class('font-bold'),
        ];

        $rows = [];

        $total = 0;

        Revenue::selectRaw('charts.name, sum(revenues.amount) as amount')
            ->join('charts', 'charts.id', '=', 'revenues.chart_id')
            ->where('charts.account_id', '=', Constant::AC_REVENUE)
            ->where('charts.enabled', '=', true)
            ->groupBy(['revenues.chart_id', 'charts.name'])
            ->get()
            ->each(function ($revenue) use (&$rows, &$total) {
                $total += ($revenue->amount ?? 0);
                $rows[] = Row::make(
                    Cell::make(ucwords($revenue->name)),
                    Cell::make(number_format($revenue->amount, 2))->class('text-right')
                );
            });

        $rows[] = Row::make(
            Cell::make('Total')->class('font-bold text-2xl'),
            Cell::make(number_format($total, 2))->class('text-right font-bold text-2xl')
        );

        $this->title('Total Revenues')
            ->header($headers)
            ->data($rows);
    }
}
