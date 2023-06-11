<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Supports\Constant;
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
                'id' => Constant::AC_ASSET,
                'name' => 'Asset',
                'enabled' => true,
            ],
            [
                'id' => Constant::AC_LIABILITY,
                'name' => 'Liability',
                'enabled' => true,
            ],
            [
                'id' => Constant::AC_EQUITY,
                'name' => 'Equity',
                'enabled' => true,
            ],
            [
                'id' => Constant::AC_REVENUE,
                'name' => 'Revenue',
                'enabled' => true,
            ],
            [
                'id' => Constant::AC_EXPENSE,
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
