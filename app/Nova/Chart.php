<?php

namespace App\Nova;

use App\Supports\Constant;
use Formfeed\Breadcrumbs\Breadcrumbs;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Chart extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Chart>
     */
    public static $model = \App\Models\Chart::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name'
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query = parent::indexQuery($request, $query);

        logger("associate", ["resource" => $request->route('resource'), "field" => $request->route('field')]);

        switch ($request->route('resource')) {
            case 'assets' :
                $query->where('account_id', Constant::AC_ASSET);
                break;

            case 'liabilities' :
                $query->where('account_id', Constant::AC_LIABILITY);
                break;

            case 'equities' :
                $query->where('account_id', Constant::AC_EQUITY);
                break;

            case 'revenues' :
                $query->where('account_id', Constant::AC_REVENUE);
                break;

            case 'expenses' :
                $query->where('account_id', Constant::AC_EXPENSE);
                break;
        }

        return $query;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->asBigInt()->sortable(),

            BelongsTo::make('User', 'user', User::class)->onlyOnDetail(),

            BelongsTo::make('Account', 'account', Account::class)
                ->sortable()
                ->filterable(),

            Text::make('Name')->sortable(),

            Boolean::make('Enabled')
                ->nullable()
                ->default(true),

            DateTime::make('Created', 'created_at')
                ->exceptOnForms(),

            DateTime::make('Updated', 'updated_at')
                ->exceptOnForms(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            Breadcrumbs::make($request, $this),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
