<?php

namespace App\Providers;

use App\Nova\Asset;
use App\Nova\Audit;
use App\Nova\Chart;
use App\Nova\Configuration;
use App\Nova\Dashboards\HistogramDashboard;
use App\Nova\Dashboards\MainDashboard;
use App\Nova\Equity;
use App\Nova\Expense;
use App\Nova\Liability;
use App\Nova\Revenue;
use App\Nova\User;
use Badinansoft\LanguageSwitch\LanguageSwitch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\LogViewer\LogViewer;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

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

        Nova::userTimezone(fn(Request $request) => ($request->user()) ? $request->user()->timezone : config('app.timezone'))
            ->mainMenu(function () {
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
                        MenuItem::resource(Expense::class),
                    ])
                        ->icon('cash')
                        ->collapsable(),

                    MenuSection::make('Settings', [
                        MenuItem::resource(Audit::class),
                        MenuItem::resource(Chart::class),
                        MenuItem::resource(Configuration::class),
                        MenuItem::link('Logs', 'logs'),
                    ])
                        ->icon('cog')
                        ->collapsable(),

                ];
            })
            ->userMenu(function (Request $request, Menu $menu) {
                $menu->append(
                    MenuItem::dashboard(HistogramDashboard::class)
                )->append(
                    MenuItem::link('My Profile', '/resources/users/' . $request->user()->getKey())
                );

                return $menu;
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
            new HistogramDashboard
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
            LanguageSwitch::make(),
            LogViewer::make(),
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
