<?php

namespace App\Supports;

class Constant
{
    const AC_ASSET = 1;

    const AC_LIABILITY = 2;

    const AC_EQUITY = 3;

    const AC_REVENUE = 4;

    const AC_EXPENSE = 5;

    const CHARTED_ACCOUNTS = [
        self::AC_ASSET => [
            ['description' => 'system generated', 'name' => 'Cash', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Petty cash', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Cash equivalents', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Short-term investments', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Accounts receivable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Allowance for doubtful accounts', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Interest receivable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Rent receivable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Notes receivable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Merchandise inventory', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Office supplies', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Prepaid insurance', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Prepaid interest', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Prepaid rent', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Long-term Investments', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Automobiles', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Accumulated depreciation- Automobiles', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Trucks', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Accumulated depreciation-Trucks', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Library', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Accumulated depreciation-Library', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Furniture', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Accumulated depreciation-Furniture', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Office Equipment', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Accumulated depreciation-Office equipment', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Machinery', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Accumulated depreciation-Machinery', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Building', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Accumulated depreciation-Building', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Land improvements', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Accumulated depreciation-Land improvements', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Land', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Mineral deposit', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Accumulated depreciation-Mineral deposit', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Patents', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Leasehold', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Franchise', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Copyrights', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Leaseholds improvements', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Licenses', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Accumulated amortization', 'enabled' => false],
        ],
        self::AC_LIABILITY => [
            ['description' => 'system generated', 'name' => 'Accounts payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Insurance payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Interest payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Legal fees payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Office salaries payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Rent payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Salaries payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Wages payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Accrued payroll payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Estimated warranty liability', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Income taxes payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Common dividend payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Preferred dividend payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'State unemployment taxes payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Employee federal income taxes payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Employee medical insurance payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Employee retirement program payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Employee union dues payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Federal unemployment taxes payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'FICA taxes payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Estimated vacation pay liability', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Unearned consulting fees', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Unearned legal fees', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Unearned property management fees', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Unearned janitorial revenue', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Unearned rent', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Short-term notes payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Notes payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Long-term notes payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Long-term lease liability', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Bonds payable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Deferred income tax liability', 'enabled' => false],
        ],
        self::AC_EQUITY => [
            ['description' => 'system generated', 'name' => 'Owner’s Capital', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Owner’s Withdrawals', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Common stock, par value', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Common stock, no par value', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Common stock, stated value', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Common stock dividend distributable', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Paid-in capital in excess of par value, Common stock', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Paid-in capital in excess of stated value, No-par common stock', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Paid-in capital from retirement of common stock', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Paid in capital, Treasury stock', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Preferred stock', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Paid-in capital in excess of par value, Preferred stock', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Retained earnings', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Cash dividends', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Stock dividends', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Treasury stock, Common', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Unrealized gain-Equity', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Unrealized loss-Equity', 'enabled' => false],
        ],
        self::AC_REVENUE => [
            ['description' => 'system generated', 'name' => 'Fees earned from product one*', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Fees earned from product two*', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Service revenue one*', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Service revenue two*', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Commissions earned', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Rent revenue', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Dividends revenue', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Earnings from investments in “blank”', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Interest revenue', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Sinking fund earnings', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Sales', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Sales returns and allowances', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Sales discounts', 'enabled' => false],
        ],
        self::AC_EXPENSE => [
            ['description' => 'system generated', 'name' => 'Amortization expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Depletion expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Depreciation expense-Automobiles', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Depreciation expense-Building', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Depreciation expense-Furniture', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Depreciation expense-Land improvements', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Depreciation expense-Library', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Depreciation expense-Machinery', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Depreciation expense-Mineral deposit', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Depreciation expense-Office equipment', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Depreciation expense-Trucks', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Office salaries expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Sales salaries expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Salaries expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => '“Blank” wages expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Employees’ benefits expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Payroll taxes expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Cash over and Short', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Discounts lost', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Factoring fee expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Interest expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Insurance expense-Delivery equipment', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Insurance expense-Office equipment', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Rent expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Rent expense-Office space', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Rent expense-Selling space', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Press rental expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Truck rental expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => '“Blank” rental expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Office supplies expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Store supplies expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => '“Blank” supplies expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Advertising expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Bad debts expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Blueprinting expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Boat expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Collection expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Concessions expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Credit card expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Delivery expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Dumping expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Equipment expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Food and drinks expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Gas and oil expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'General and administrative expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Janitorial expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Legal fees expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Mileage expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Miscellaneous expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Mower and tool expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Operating expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Organization expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Permits expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Postage expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Property taxes expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Repairs expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Selling expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Telephone expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Travel and entertainment expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Utilities expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Warranty expense', 'enabled' => false],
            ['description' => 'system generated', 'name' => 'Income taxes expense', 'enabled' => false],
        ],
    ];

    const ACCOUNT_LABELS = [
        self::AC_ASSET => 'Assets',
        self::AC_LIABILITY => 'Liabilities',
        self::AC_EQUITY => 'Equities',
        self::AC_REVENUE => 'Revenues',
        self::AC_EXPENSE => 'Expenses',
    ];

    const DEFAULT_CONFIG = [
        //Sidebar Labels
        [
            'name' => 'Asset Account Label',
            'key' => 'asset-label',
            'value' => self::ACCOUNT_LABELS[self::AC_ASSET],
            'enabled' => true,
        ],
        [
            'name' => 'Liability Account Label',
            'key' => 'liability-label',
            'value' => self::ACCOUNT_LABELS[self::AC_LIABILITY],
            'enabled' => true,
        ],
        [
            'name' => 'Equity Account Label',
            'key' => 'equity-label',
            'value' => self::ACCOUNT_LABELS[self::AC_EQUITY],
            'enabled' => true,
        ],
        [
            'name' => 'Revenue Account Label',
            'key' => 'revenue-label',
            'value' => self::ACCOUNT_LABELS[self::AC_REVENUE],
            'enabled' => true,
        ],
        [
            'name' => 'Expense Account Label',
            'key' => 'expense-label',
            'value' => self::ACCOUNT_LABELS[self::AC_EXPENSE],
            'enabled' => true,
        ],

        //Calendar Color
        [
            'name' => 'Asset Calendar Color',
            'key' => 'asset-color',
            'value' => self::ACCOUNT_LABELS[self::AC_ASSET],
            'enabled' => true,
        ],
        [
            'name' => 'Liability Calendar Color',
            'key' => 'liability-color',
            'value' => self::ACCOUNT_LABELS[self::AC_LIABILITY],
            'enabled' => true,
        ],
        [
            'name' => 'Equity Calendar Color',
            'key' => 'equity-color',
            'value' => self::ACCOUNT_LABELS[self::AC_EQUITY],
            'enabled' => true,
        ],
        [
            'name' => 'Revenue Calendar Color',
            'key' => 'revenue-color',
            'value' => self::ACCOUNT_LABELS[self::AC_REVENUE],
            'enabled' => true,
        ],
        [
            'name' => 'Expense Calendar Color',
            'key' => 'expense-color',
            'value' => self::ACCOUNT_LABELS[self::AC_EXPENSE],
            'enabled' => true,
        ],
    ];
}
