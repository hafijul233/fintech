<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Audit extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\OwenIt\Auditing\Models\Audit>
     */
    public static $model = \OwenIt\Auditing\Models\Audit::class;

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
        'user.name', 'user.email', 'event', 'auditable_type', 'auditable_id', 'old_values', 'new_values', 'url', 'ip_address', 'user_agent', 'tags',
    ];

    public function authorizedToAdd(NovaRequest $request, $model)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            MorphTo::make('User')->types([
                \App\Nova\User::class,
            ])->nullable(),

            Badge::make('Event')
                ->map([
                    'created' => 'success',
                    'updated' => 'warning',
                    'deleted' => 'danger',
                    'restored' => 'info',
                ]),
            MorphTo::make('Auditable')
                ->types([
                    \App\Nova\Account::class,
                    \App\Nova\Asset::class,
                    \App\Nova\Chart::class,
                    \App\Nova\Configuration::class,
                    \App\Nova\Equity::class,
                    \App\Nova\Expense::class,
                    \App\Nova\Liability::class,
                    \App\Nova\Revenue::class,
                    \App\Nova\User::class,
                ])->nullable(),

            KeyValue::make('Old Values', 'old_values')
                ->rules('json')
                ->keyLabel('Property')
                ->valueLabel('Value'),

            KeyValue::make('New Values', 'new_values')
                ->rules('json')
                ->keyLabel('Property')
                ->valueLabel('Value'),

            Text::make('Action From', 'url')->hideFromIndex(),

            Text::make('IP Address'),

            Text::make('User Agent')->hideFromIndex(),

            Text::make('Tags')->hideFromIndex(),

            DateTime::make('Created At')->exceptOnForms(),

            DateTime::make('Updated At')->exceptOnForms(),


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
        return [];
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
