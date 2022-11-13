<?php

namespace App\Supports;

class Constant
{
    const AC_ASSET = 1;

    const AC_LIABILITY = 2;

    const AC_EQUITY = 3;

    const AC_REVENUE = 4;

    const AC_EXPENSE = 5;

    const AUDIT_EVENTS = [
        'created' => 'Create',
        'updated' => 'Update',
        'deleted' => 'Delete',
        'restored' => 'Restore',
    ];
}
