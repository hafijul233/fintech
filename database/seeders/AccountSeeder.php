<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
            [
                'id' => '1',
                'start' => '101',
                'end' => '199',
                'name' => 'Asset',
                'enabled' => true,
            ],
            [
                'id' => '2',
                'start' => '201',
                'end' => '299',
                'name' => 'Liability',
                'enabled' => true,
            ],
            [
                'id' => '3',
                'start' => '301',
                'end' => '399',
                'name' => 'Equity',
                'enabled' => true,
            ],
            [
                'id' => '4',
                'start' => '401',
                'end' => '499',
                'name' => 'Revenue',
                'enabled' => true,
            ],
            [
                'id' => '5',
                'start' => '501',
                'end' => '599',
                'name' => 'Expense',
                'enabled' => true,
            ],
        ];

        try {
            DB::beginTransaction();
            foreach ($accounts as $account) {
                Account::create($account);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->command->error($exception->getMessage());
        }
    }
}
