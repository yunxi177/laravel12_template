<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        parent::boot();

        $this->configureRateLimiting();

        $this->mapAdminRoutes();
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        //
    }

    /**
     * Map the admin routes.
     */
    protected function mapAdminRoutes(): void
    {
        Route::prefix('api')
            ->namespace($this->namespace)
            ->group(function () {
                foreach (glob(base_path('routes/apis/*.php')) as $file) {
                    require $file;
                }
            });
        Route::prefix('admin')
            ->namespace($this->namespace)
            ->group(function () {
                foreach (glob(base_path('routes/admin.php')) as $file) {
                    require $file;
                }
            });
        Route::prefix('external')
            ->namespace($this->namespace)
            ->group(function () {
                foreach (glob(base_path('routes/external.php')) as $file) {
                    require $file;
                }
            });
    }
}
