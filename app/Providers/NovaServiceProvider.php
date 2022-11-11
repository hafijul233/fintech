<?php

namespace App\Providers;

use App\Nova\Dashboards\MainDashboard;
use Badinansoft\LanguageSwitch\LanguageSwitch;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\LogViewer\LogViewer;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Oneduo\NovaFileManager\NovaFileManager;
use Spatie\BackupTool\BackupTool;
use Stepanenko3\LogsTool\LogsTool;
use Visanduma\NovaBackNavigation\NovaBackNavigation;
use Vyuldashev\NovaPermission\NovaPermissionTool;
use Wdelfuego\Nova4\CustomizableFooter\Footer;

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
        Footer::set('<p class="text-center">My Testing Footer</p>');
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
            NovaPermissionTool::make(),
            NovaBackNavigation::make(),
            LanguageSwitch::make(),
            NovaFileManager::make(),
            LogViewer::make(),
            BackupTool::make(),
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
