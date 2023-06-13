<?php

namespace App\Nova;

use App\Nova\Actions\Common\ChangeEntryDateAction;
use App\Nova\Filters\Common\EndDateFilter;
use App\Nova\Filters\Common\StartDateFilter;
use Formfeed\Breadcrumbs\Breadcrumbs;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;

abstract class Resource extends NovaResource
{
    protected $preferCurrency;

    public function __construct($resource = null)
    {
        parent::__construct($resource);

        $this->preferCurrency = request()->user()->currency;

    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('user_id', '=', $request->user()->id);
    }

    /**
     * Build a Scout search query for the given resource.
     *
     * @param  \Laravel\Scout\Builder  $query
     * @return \Laravel\Scout\Builder
     */
    public static function scoutQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a "detail" query for the given resource.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public static function detailQuery(NovaRequest $request, $query)
    {
        return parent::detailQuery($request, $query);
    }

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public static function relatableQuery(NovaRequest $request, $query)
    {
        return parent::relatableQuery($request, $query);
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            Breadcrumbs::make($request, $this),
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
            ChangeEntryDateAction::make(),
            ExportAsCsv::make(),
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
            /*            StartDateFilter::make(),
            EndDateFilter::make(),*/
        ];
    }

    /**
     * Get the lenses available on the resource.
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }
}
