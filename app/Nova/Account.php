<?php

namespace App\Nova;

use Devpartners\AuditableLog\AuditableLog;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Account extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Account>
     */
    public static $model = \App\Models\Account::class;

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
        'id', 'name',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->asBigInt()->sortable()->hideFromDetail(),

            Text::make('Name')->sortable(),

            Boolean::make('Enabled')
                ->nullable()
                ->sortable()
                ->default(true),

            DateTime::make('Created', 'created_at')
                ->onlyOnDetail(),

            DateTime::make('Updated', 'updated_at')
                ->onlyOnDetail(),

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
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
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
