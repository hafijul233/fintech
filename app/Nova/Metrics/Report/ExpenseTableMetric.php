<?php

namespace App\Nova\Metrics\Report;

use App\Models\Expense;
use App\Supports\Constant;
use App\Traits\UserConfigTrait;
use Whitespacecode\TableCard\Table\Cell;
use Whitespacecode\TableCard\Table\Row;
use Whitespacecode\TableCard\TableCard;

class ExpenseTableMetric extends TableCard
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

        Expense::selectRaw('charts.name, sum(expenses.amount) as amount')
            ->join('charts', 'charts.id', '=', 'expenses.chart_id')
            ->where('charts.account_id', '=', Constant::AC_EXPENSE)
            ->where('charts.enabled', '=', true)
            ->groupBy(['expenses.chart_id', 'charts.name'])
            ->get()
            ->each(function ($expense) use (&$rows, &$total) {
                $total += ($expense->amount ?? 0);
                $rows[] = Row::make(
                    Cell::make(ucwords($expense->name)),
                    Cell::make($this->currency($expense->amount))->class('text-right')
                );
            });

        $rows[] = Row::make(
            Cell::make('Total')->class('text-2xl'),
            Cell::make($this->currency($total))->class('text-right text-2xl')
        );

        $this->title('Total Expenses')
            ->header($headers)
            ->data($rows);
    }
}
