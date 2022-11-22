<?php

namespace App\Nova\Metrics\Report;

use App\Models\Expense;
use App\Models\Revenue;
use App\Supports\Constant;
use JoeriTheGreat\TableCard\Table\Cell;
use JoeriTheGreat\TableCard\Table\Row;
use JoeriTheGreat\TableCard\TableCard;

class IncomeStatementTableMetric extends TableCard
{
    public function __construct(array $header = [], array $data = [], string $title = '', bool $viewAll = false)
    {
        parent::__construct($header, $data, $title, $viewAll);

        $currency = request()->user()->currency ?? 'USD';

        $headers = [
            Cell::make('Name')->class('font-bold'),
            Cell::make('Amount')
                ->class('font-bold'),
        ];

        $totalRevenues = Revenue::all()->sum('amount');

        $totalExpenses = Expense::all()->sum('amount');


        $rows[] = Row::make(
            Cell::make('Total Revenues'),
            Cell::make(
                config("fintech.currency.{$currency}.symbol")
                . ' '
                . number_format($totalRevenues, 2)
            )->class('text-right')
        );

        $rows[] = Row::make(
            Cell::make('Total Expenses'),
            Cell::make(
                config("fintech.currency.{$currency}.symbol")
                . number_format($totalExpenses, 2)
            )->class('text-right')
        );

        $total = $totalRevenues - $totalExpenses;

        $rows[] = Row::make(
            Cell::make('Total')->class('font-bold text-2xl'),
            Cell::make(number_format($total, 2))->class('text-right font-bold text-2xl')
        );

        $this->title('Income Statement')
            ->header($headers)
            ->data($rows);
    }
}
