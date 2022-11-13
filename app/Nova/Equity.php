<?php

namespace App\Nova;

use App\Supports\Constant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
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
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->asBigInt()->sortable(),

            Date::make('Entry', 'entry')
                ->required()
                ->default(fn() => date('Y-m-d'))
                ->rules(['date_format:Y-m-d', 'required', 'date', 'before_or_equal:' . date('Y-m-d')]),

            BelongsTo::make('Chart', 'chart', Chart::class)
                ->required()
                ->searchable()
                ->rules(['required', 'integer',
                    Rule::in(\App\Models\Chart::where('account_id', '=', Constant::AC_EQUITY)
                        ->get()->pluck('id')->toArray())
                ])->showCreateRelationButton(),

            Text::make('Description', 'description')
                ->required()
                ->suggestions(fn() => \App\Models\Asset::select('description')
                    ->get()->pluck('description')->toArray()
                ),

            Number::make('Amount', 'amount')
                ->step(4)
                ->required()
                ->min(0)
                ->displayUsing(fn($value) => number_format($value, 2)),

            Textarea::make('Notes', 'notes')
                ->nullable(),

            DateTime::make('Created', 'created_at')
                ->exceptOnForms(),

            DateTime::make('Updated', 'updated_at')
                ->exceptOnForms(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
