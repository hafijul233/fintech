<?php

namespace App\Traits;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\TrendDateExpressionFactory;
use Laravel\Nova\Metrics\TrendResult;
use Laravel\Nova\Nova;

trait TrendQueryTrait
{
    /**
     * Return a value result showing an aggregate over time.
     *
     * @param  NovaRequest  $request
     * @param  Builder|class-string<Model>  $model
     * @param  string  $unit
     * @param  string  $function
     * @param  Expression|string  $column
     * @param  string|null  $dateColumn
     * @return TrendResult
     */
    public function aggregate($request, $model, $unit, $function, $column, $dateColumn = null)
    {
        $query = $model instanceof Builder ? $model : (new $model)->newQuery();

        $timezone = Nova::resolveUserTimezone($request) ?? $this->getDefaultTimezone($request);

        $dateColumn = $dateColumn ?? $query->getModel()->getQualifiedCreatedAtColumn();

        $minDate = $query->min($dateColumn);

        $expression = (string) TrendDateExpressionFactory::make(
            $query, $dateColumn,
            $unit, $timezone
        );

        $endingDate = CarbonImmutable::now($timezone);

        $startingDate = match ($request->range) {
            'TODAY' => $endingDate->startOfDay()->setTime(0, 0),

            'YESTERDAY' => $endingDate->subDay()->startOfDay()->setTime(0, 0),

            'MTD' => $endingDate->startOfMonth()->setTime(0, 0),

            'QTD' => $endingDate->startOfQuarter()->setTime(0, 0),

            'YTD' => $endingDate->startOfYear()->setTime(0, 0),

            'ALL' => CarbonImmutable::parse($minDate)->setTime(0, 0),

            default => $endingDate->subDays($request->range)->setTime(0, 0)
        };

        $possibleDateResults = $this->getAllPossibleDateResults(
            $startingDate,
            $endingDate,
            $unit,
            $request->twelveHourTime === 'true'
        );

        $wrappedColumn = $column instanceof Expression
            ? (string) $column
            : $query->getQuery()->getGrammar()->wrap($column);

        $results = $query
            ->select(DB::raw("{$expression} as date_result, {$function}({$wrappedColumn}) as aggregate"))
            ->tap(function ($query) use ($request) {
                return $this->applyFilterQuery($request, $query);
            })
            ->whereBetween(
                $dateColumn, $this->formatQueryDateBetween([$startingDate, $endingDate])
            )->groupBy(DB::raw($expression))
            ->orderBy('date_result')
            ->get();

        $results = array_merge($possibleDateResults, $results->mapWithKeys(function ($result) use ($request, $unit) {
            return [$this->formatAggregateResultDate(
                $result->date_result, $unit, $request->twelveHourTime === 'true'
            ) => round($result->aggregate, $this->roundingPrecision, $this->roundingMode)];
        })->all());

        if (count($results) > $request->range) {
            array_shift($results);
        }

        return $this->result(Arr::last($results))->trend(
            $results
        );
    }
}
