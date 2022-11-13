<?php

namespace App\Providers;

use App\Nova\Account;
use App\Nova\Asset;
use App\Nova\Chart;
use App\Nova\Configuration;
use App\Nova\Dashboards\MainDashboard;
use App\Nova\Equity;
use App\Nova\Expense;
use App\Nova\Liability;
use App\Nova\Revenue;
use App\Nova\User;
use Badinansoft\LanguageSwitch\LanguageSwitch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\LogViewer\LogViewer;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Visanduma\NovaBackNavigation\NovaBackNavigation;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::userTimezone(function (Request $request) {
            return ($request->user())
                ? $request->user()->timezone
                : config('app.timezone');
        });

        Nova::mainMenu(function () {
            return [
                MenuSection::dashboard(MainDashboard::class)
                    ->icon('chart-bar'),

                MenuSection::resource(User::class)
                    ->icon('user'),

                MenuSection::make('Accounts', [
                    MenuItem::resource(Asset::class),
                    MenuItem::resource(Liability::class),
                    MenuItem::resource(Equity::class),
                    MenuItem::resource(Revenue::class),
                    MenuItem::resource(Expense::class)
                ])
                    ->icon('cash')
                    ->collapsable(),

                MenuSection::make('Settings', [
                    MenuItem::resource(Account::class),
                    MenuItem::resource(Chart::class),
                    MenuItem::resource(Configuration::class),
                ])
                    ->icon('cog')
                    ->collapsable(),
            ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new MainDashboard,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            NovaBackNavigation::make(),
            LanguageSwitch::make(),
/*            NovaFileManager::make(),
            LogViewer::make(),
            BackupTool::make(),*/
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
