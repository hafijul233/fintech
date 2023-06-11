<?php

namespace App\Nova\Actions\Common;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;

class ChangeStatusAction extends Action
{
    /**
     * The displayable name of the action.
     *
     * @var string
     */
    public $name = 'Change Status';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        DB::beginTransaction();
        try {
            foreach ($models as $model) {
                $model->enabled = $fields->enabled;
                $model->save();
            }
            DB::commit();

            return Action::message(class_basename(get_class($models->first())).'s enabled status update successful');
        } catch (\Exception $exception) {
            DB::rollBack();
            logger('Action Exception: '.$exception->getMessage(), $exception->getTrace());

            return Action::danger(class_basename(get_class($models->first())).'s enabled status update failed');
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Boolean::make('Enabled', 'enabled')
                ->default(function () {
                    return true;
                }),
        ];
    }
}
