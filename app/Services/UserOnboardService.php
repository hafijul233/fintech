<?php

namespace App\Services;

use App\Models\Chart;
use App\Models\Configuration;
use App\Models\User;
use App\Supports\Constant;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserOnboardService
{
    public function __construct(public User $user)
    {
    }

    public function setup(array $options = [])
    {
        $this->createChartedAccounts();
        $this->createDefaultConfig();
    }

    private function createChartedAccounts(): bool
    {
        Model::unguard();
        try {
            DB::beginTransaction();
            foreach (Constant::CHARTED_ACCOUNTS as $account_id => $chart) {
                foreach ($chart as $entry) {
                    $entry['user_id'] = $this->user->id;
                    $entry['account_id'] = $account_id;
                    Chart::create($entry);
                }
            }
            DB::commit();
            Model::reguard();

            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            logger('User Onboard Chart Exception: ' . $exception->getMessage());

            return true;
        }
    }

    private function createDefaultConfig()
    {
        Model::unguard();
        try {
            DB::beginTransaction();
            foreach (Constant::DEFAULT_CONFIG as $entry) {
                $entry['user_id'] = $this->user->id;
                Configuration::create($entry);
            }
            DB::commit();
            Model::reguard();

            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            logger('User Onboard Config Exception: ' . $exception->getMessage());

            return true;
        }
    }
}
