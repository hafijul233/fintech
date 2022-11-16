<?php

namespace App\Nova\Actions\Common;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;

class ChangeStatusAction extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
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
            return Action::message(class_basename(get_class($models->first())) . "s enabled status update successful");
        } catch (\Exception $exception) {
            DB::rollBack();
            logger("Action Exception: " . $exception->getMessage(), $exception->getTrace());
            return Action::danger(class_basename(get_class($models->first())) . "s enabled status update failed");
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Boolean::make('Enabled', 'enabled')->default(function () {
                return true;
            }),
        ];
    }
}
