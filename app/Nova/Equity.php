<?php

namespace App\Nova;

use App\Nova\Metrics\Equity\EquityPerDayMetric;
use App\Nova\Metrics\Equity\TotalEquityMetric;
use App\Supports\Constant;
use Carbon\CarbonImmutable;
use Devpartners\AuditableLog\AuditableLog;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Equity extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Equity>
     */
    public static $model = \App\Models\Equity::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'description',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->asBigInt()->sortable(),

            Date::make('Entry', 'entry')
                ->required()
                ->sortable()
                ->filterable()
                ->default(fn () => CarbonImmutable::now($request->user()->timezone ?? 'UTC')->format('Y-m-d'))
                ->rules(['date_format:Y-m-d', 'required', 'date']),

            BelongsTo::make('Category', 'chart', Chart::class)
                ->required()
                ->sortable()
                ->filterable()
                ->rules(['required', 'integer',
                    Rule::in(\App\Models\Chart::where('account_id', '=', Constant::AC_EQUITY)
                        ->get()->pluck('id')->toArray()),
                ])->showCreateRelationButton(),

            Text::make('Description', 'description')
                ->required()
                ->sortable()
                ->suggestions(fn () => array_unique(\App\Models\Equity::select('description')
                    ->get()->pluck('description')->toArray())
                ),

            Currency::make('Amount', 'amount')
                ->required()
                ->sortable()
                ->currency($this->preferCurrency),

            Textarea::make('Notes', 'notes')
                ->hideFromIndex()
                ->nullable(),

            DateTime::make('Created', 'created_at')
                ->onlyOnDetail(),

            DateTime::make('Updated', 'updated_at')
                ->onlyOnDetail(),

            Files::make('Attachments', 'attachments')->nullable(),

            AuditableLog::make(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            ...parent::cards($request),

            TotalEquityMetric::make()
                ->refreshWhenActionsRun()
                ->refreshWhenFiltersChange(),

            EquityPerDayMetric::make()
                ->refreshWhenActionsRun()
                ->refreshWhenFiltersChange(),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            ...parent::filters($request),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [
            ...parent::lenses($request),
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            ...parent::actions($request),
        ];
    }
}
