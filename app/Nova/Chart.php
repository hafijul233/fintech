<?php

namespace App\Nova;

use App\Nova\Actions\Common\ChangeStatusAction;
use App\Supports\Constant;
use Devpartners\AuditableLog\AuditableLog;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
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
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Categories';
    }

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
        $query = parent::indexQuery($request, $query);

        switch ($request->route('resource')) {
            case 'assets':
                $query->enabled()->where('account_id', Constant::AC_ASSET);
                break;

            case 'liabilities':
                $query->enabled()->where('account_id', Constant::AC_LIABILITY);
                break;

            case 'equities':
                $query->enabled()->where('account_id', Constant::AC_EQUITY);
                break;

            case 'revenues':
                $query->enabled()->where('account_id', Constant::AC_REVENUE);
                break;

            case 'expenses':
                $query->enabled()->where('account_id', Constant::AC_EXPENSE);
                break;
        }

        return $query->orderBy('enabled')->orderBy('id', 'desc');
    }

    /**
     * Get the fields displayed by the resource.
     *
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

            Textarea::make('Description')->sortable(),

            Boolean::make('Enabled')
                ->nullable()
                ->sortable()
                ->filterable()
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
            ChangeStatusAction::make(),
        ];
    }
}
