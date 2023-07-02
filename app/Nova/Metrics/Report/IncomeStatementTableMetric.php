<?php

namespace App\Nova\Metrics\Report;

use App\Models\Asset;
use App\Models\Expense;
use App\Traits\UserConfigTrait;
use Whitespacecode\TableCard\Table\Cell;
use Whitespacecode\TableCard\Table\Row;
use Whitespacecode\TableCard\TableCard;

class IncomeStatementTableMetric extends TableCard
{
    use UserConfigTrait;

    public function __construct(array $header = [], array $data = [], string $title = '', bool $viewAll = false)
    {
        parent::__construct($header, $data, $title, $viewAll);

        $headers = [
            Cell::make('Name'),
            Cell::make('Amount')
                ->class('font-bold'),
        ];

        $totalAssets = Asset::all()->sum('amount');

        $totalExpenses = Expense::all()->sum('amount');

        $rows[] = Row::make(
            Cell::make('Total Assets'),
            Cell::make($this->currency($totalAssets)
            )->class('text-right')
        );

        $rows[] = Row::make(
            Cell::make('Total Expenses'),
            Cell::make($this->currency($totalExpenses)
            )->class('text-right')
        );

        $total = $totalAssets - $totalExpenses;

        $rows[] = Row::make(
            Cell::make('Total')->class('text-2xl'),
            Cell::make($this->currency($total))->class('text-right text-2xl')
        );

        $this->title('Income Statement')
            ->header($headers)
            ->data($rows);
    }
}
