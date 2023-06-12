<?php

namespace App\Providers;

use App\Nova\Asset;
use App\Nova\Expense;
use App\Nova\Liability;
use App\Nova\Revenue;
use Wdelfuego\NovaCalendar\DataProvider\MonthCalendar;
use Wdelfuego\NovaCalendar\EventFilter\NovaResourceFilter;

class CalendarDataProvider extends MonthCalendar
{
    //
    // Add the Nova resources that should be displayed on the calendar to this method
    //
    // Must return an array with string keys and string or array values;
    // - each key is a Nova resource class name (eg: 'App/Nova/User::class')
    // - each value is either:
    //
    //   1. a string containing the attribute name of a DateTime casted attribute
    //      of the underlying Eloquent model that will be used as the event's
    //      starting date and time (eg.: 'created_at')
    //
    //      OR
    //
    //   2. an array containing two strings; the first is the name of the attribute
    //      that will be used as the event's starting date and time (eg.: 'starts_at'),
    //      the second will be used as the event's ending date and time (eg.: 'ends_at').
    //
    // See https://github.com/wdelfuego/nova-calendar to find out
    // how to customize the way the events are displayed
    //
    public function novaResources(): array
    {
        return [
            Asset::class => 'created_at',
            Liability::class => 'created_at',
            Expense::class => 'created_at',
            Revenue::class => 'created_at',

        ];
    }

    // Use this method to show events on the calendar that don't
    // come from a Nova resource. Just return an array of dynamically
    // generated events.
//    protected function nonNovaEvents(): array
//    {
//        return [
//            (new Event('Today until tomorrow', now()->subDays(1), now()->addDays(1)))
//                ->displayTime()
//                ->addBadges('👍')
//                ->withNotes('these are the event notes'),
//
//            (new Event('Today until tomorrow', now()->subDays(2), now()->addDays(2)))
//                ->displayTime()
//                ->addBadges('👍')
//                ->withNotes('these are the event notes'),
//
//            (new Event('Today until tomorrow', now()->subDays(3), now()->addDays(3)))
//                ->displayTime()
//                ->addBadges('👍')
//                ->withNotes('these are the event notes'),
//
//            (new Event('Today until tomorrow', now()->subDays(4), now()->addDays(4)))
//                ->displayTime()
//                ->addBadges('👍')
//                ->withNotes('these are the event notes'),
//        ];
//    }

    public function filters(): array
    {
        return [
            new NovaResourceFilter(__('Only Assets'), Asset::class),
            new NovaResourceFilter(__('Only Liability'), Liability::class),
            new NovaResourceFilter(__('Only Expense'), Expense::class),
        ];
    }

    public function timezone(): string
    {
        return $this->request->user()->timezone ?? config('app.timezone');
    }
}
