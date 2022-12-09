<?php

namespace App\Nova\Actions\Common;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Http\Requests\NovaRequest;

class ChangeEntryDateAction extends Action
{
    /**
     * The displayable name of the action.
     *
     * @var string
     */
    public $name = 'Change Entry Date';

    /**
     * Perform the action on the given models.
     *
     * @param  ActionFields  $fields
     * @param  Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        DB::beginTransaction();
        try {
            foreach ($models as $model) {
                $model->entry = $fields->entry;
                $model->save();
            }
            DB::commit();

            return Action::message(class_basename(get_class($models->first())).'s entry date update successful');
        } catch (\Exception $exception) {
            DB::rollBack();
            logger('Action Exception: '.$exception->getMessage(), $exception->getTrace());

            return Action::danger(class_basename(get_class($models->first())).'s entry date update failed');
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Date::make('Entry Date', 'entry')
                ->default(fn () => CarbonImmutable::now($request->user()->timezone ?? 'UTC')->format('Y-m-d')),
        ];
    }
}
