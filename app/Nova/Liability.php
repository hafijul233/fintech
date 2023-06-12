<?php

namespace App\Nova;

use Alexwenzel\DependencyContainer\DependencyContainer;
use App\Nova\Metrics\Liability\LiabilityPerDayMetric;
use App\Nova\Metrics\Liability\TotalLiabilityMetric;
use App\Supports\Constant;
use Carbon\CarbonImmutable;
use Devpartners\AuditableLog\AuditableLog;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Liability extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Liability>
     */
    public static $model = \App\Models\Liability::class;

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
                ->searchable()
                ->filterable()
                ->rules(['required', 'integer',
                    Rule::in(\App\Models\Chart::where('account_id', '=', Constant::AC_LIABILITY)
                        ->get()->pluck('id')->toArray()),
                ])->showCreateRelationButton(),

            Text::make('Description', 'description')
                ->required()
                ->sortable()
                ->suggestions(fn () => array_unique(\App\Models\Liability::select('description')
                    ->get()->pluck('description')->toArray())
                ),

            Currency::make('Amount', 'amount')
                ->required()
                ->sortable()
                ->currency($this->preferCurrency),

            Textarea::make('Notes', 'notes')
                ->hideFromIndex()
                ->nullable(),

            Boolean::make('Deduct From Asset?', 'deduct_asset')
                ->trueValue(true)
                ->falseValue(false)
                ->default(true)
                ->hideFromIndex(),

            DependencyContainer::make([
                Select::make('Asset Category', 'asset_category_id')
                    ->required()
                    ->options(function () {
                        return \App\Models\Chart::enabled()->where('account_id', '=', Constant::AC_ASSET)
                            ->get()->pluck('name', 'id')->toArray();
                    })
            ])->dependsOn('deduct_asset', true),

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

            TotalLiabilityMetric::make()
                ->refreshWhenActionsRun()
                ->refreshWhenFiltersChange(),

            LiabilityPerDayMetric::make()
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

    /**
     * Fill a new model instance using the given request.
     *
     * @param NovaRequest $request
     * @param Model $model
     * @return array{Model, array<int, callable>}
     */
    public static function fill(NovaRequest $request, $model)
    {
        return static::fillFields(
            $request, $model,
            (new static($model))
                ->creationFields($request)
                ->applyDependsOn($request)
                ->withoutReadonly($request)
                ->reject(function ($field) use (&$request) {
                    return in_array($field->attribute, ["", 'asset_category_id']);
                })
        );
    }

    /**
     * Register a callback to be called after the resource is created.
     *
     * @param NovaRequest $request
     * @param Model $model
     * @return void
     */
    public static function afterCreate(NovaRequest $request, Model $model)
    {
        if ($request->has('deduct_asset') && $request->boolean('deduct_asset')) {

            $assetValues = [
                'entry' => $model->entry,
                'user_id' => $request->user()->id,
                'chart_id' => $request->input('asset_category_id'),
                'description' => $model->description ?? null,
                'amount' => -1 * $model->amount,
                'notes' => $model->notes
            ];

            \App\Models\Asset::create($assetValues);
        }
    }
}
