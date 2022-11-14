<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\UserOnboardService;
use Illuminate\Database\Seeder;

class ChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(...$params)
    {
        $user_id = $params[0] ?? null;
        if ($user = User::find($user_id)) {
            $userOnboardService = new UserOnboardService($user);
            $userOnboardService->setup();
        }
    }
}
