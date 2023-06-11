<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configurations = [
            [
                'name' => 'Asset Account Label',
                'key' => 'asset-label',
                'value' => 'Assets',
                'enabled' => true,
            ],            [
                'name' => 'Liability Account Label',
                'key' => 'liability-label',
                'value' => 'Liabilities',
                'enabled' => true,
            ],            [
                'name' => 'Equity Account Label',
                'key' => 'equity-label',
                'value' => 'Equities',
                'enabled' => true,
            ],            [
                'name' => 'Revenue Account Label',
                'key' => 'revenue-label',
                'value' => 'Revenues',
                'enabled' => true,
            ],            [
                'name' => 'Expense Account Label',
                'key' => 'expense-label',
                'value' => 'Expenses',
                'enabled' => true,
            ],
        ];

    }
}
