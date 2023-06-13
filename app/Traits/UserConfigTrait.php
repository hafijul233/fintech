<?php

namespace App\Traits;

use Laravel\Nova\Http\Requests\NovaRequest;

trait UserConfigTrait
{
    public function userPrefer()
    {
        return app(NovaRequest::class)->user();
    }

    public function currency($value, string $currency = null)
    {
        $currency = $currency ?? $this->userPrefer()->currency;

        $money = config("fintech.currency.{$currency}");

        if (is_numeric($value)) {
            $value = number_format($value, $money['precision'], $money['decimal_mark'], $money['thousands_separator']);

            return ($money['symbol_first'])
                ? $money['symbol']."{$value} {$currency}s"
                : "{$currency} $value".$money['symbol'];
        }

        return '-';
    }
}
