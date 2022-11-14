<?php

namespace App\Nova;

use Devpartners\AuditableLog\AuditableLog;
use Formfeed\Breadcrumbs\Breadcrumbs;
use Greg0x46\MaskedField\MaskedField;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

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
        'id', 'name', 'email',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->where('id', '=', $request->user()->id)
            ->orWhere('user_id', '=', $request->user()->id);

        return $query;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->asBigInt()->sortable(),

            BelongsTo::make('Referred By', 'parent', User::class)->onlyOnDetail(),

            Gravatar::make()->maxWidth(50),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Email::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Select::make('Phone Code', 'phone_code')
                ->options(config('fintech.phone_codes'))
                ->nullable()
                ->searchable()
                ->hideFromIndex()
                ->displayUsingLabels(),

            MaskedField::make('Phone')
                ->mask('(###) ###-####')
                ->displayUsing(fn () => "{$this->phone_code} {$this->phone}"),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),

            Text::make('Street Address', 'street')
                ->nullable()
                ->sortable()
                ->hideFromIndex(),

            Text::make('City')
                ->nullable()
                ->hideFromIndex(),

            Text::make('State')
                ->nullable()
                ->hideFromIndex(),

            Text::make('Zipcode')
                ->nullable()
                ->hideFromIndex(),

            Country::make('Country')
                ->sortable()
                ->filterable()
                ->searchable()
                ->nullable()
                ->displayUsingLabels(),

            Select::make('Timezone')
                ->options(config('fintech.timezones'))
                ->searchable()
                ->sortable()
                ->filterable()
                ->required()
                ->hideFromIndex()
                ->displayUsingLabels()
                ->default(fn () => config('app.timezone')),

            DateTime::make('Created', 'created_at')
                ->exceptOnForms(),

            DateTime::make('Updated', 'updated_at')
                ->exceptOnForms(),

            AuditableLog::make(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  NovaRequest  $request
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
     * @param  NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
