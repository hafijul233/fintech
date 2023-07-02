<?php

namespace App\Nova\Metrics\Report;

use App\Models\Asset;
use App\Supports\Constant;
use App\Traits\UserConfigTrait;
use Whitespacecode\TableCard\Table\Cell;
use Whitespacecode\TableCard\Table\Row;
use Whitespacecode\TableCard\TableCard;

class AssetTableMetric extends TableCard
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
        Asset::selectRaw('`charts`.`name`, sum(amount) as `amount`')
            ->where('amount', '>=', 0)
            ->join('charts', 'charts.id', '=', 'assets.chart_id')
            ->where('charts.account_id', '=', Constant::AC_ASSET)
            ->where('charts.enabled', '=', true)
            ->groupBy(['assets.chart_id', 'charts.name'])
            ->orderBy('amount', 'desc')
            ->get()
            ->each(function ($asset) use (&$rows, &$total, &$count) {
                $total += ($asset->amount ?? 0);
                $rows[] = Row::make(
                    Cell::make(ucwords($asset->name)),
                    Cell::make($this->currency($asset->amount))->class('text-right')
                );
            });

        $rows[] = Row::make(
            Cell::make('Total')->class('text-2xl'),
            Cell::make($this->currency($total))->class('text-right text-2xl')
        );

        // $this->style = 'table-default margin-1rem table-border';

        $this->title('Total Assets')
            ->header($headers)
            ->data($rows);
    }
}
