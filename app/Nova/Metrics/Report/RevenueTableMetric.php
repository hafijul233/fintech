<?php

namespace App\Nova\Metrics\Report;

use App\Models\Revenue;
use App\Supports\Constant;
use App\Traits\UserConfigTrait;
use Whitespacecode\TableCard\Table\Cell;
use Whitespacecode\TableCard\Table\Row;
use Whitespacecode\TableCard\TableCard;

class RevenueTableMetric extends TableCard
{
    use UserConfigTrait;

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
            ->each(function ($revenue) use (&$rows, &$total, &$currency) {
                $total += ($revenue->amount ?? 0);
                $rows[] = Row::make(
                    Cell::make(ucwords($revenue->name)),
                    Cell::make($this->currency($revenue->amount))->class('text-right')
                );
            });

        $rows[] = Row::make(
            Cell::make('Total')->class('text-2xl'),
            Cell::make($this->currency($total))->class('text-right text-2xl')
        );

        $this->title('Total Revenues')
            ->header($headers)
            ->data($rows);
    }
}
