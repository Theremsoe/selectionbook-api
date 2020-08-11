<?php

namespace App\Providers;

use App\Model\Address;
use App\Model\Skill;
use App\Model\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Route as Routing;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        parent::boot();

        Route::bind(
            'user_address',
            fn (string $value, Routing $route): Address => Address::query()
                ->where('addressable_type', User::class)
                ->where('addressable_id', $route->parameters['user'])
                ->where('id', $value)
                ->firstOrFail()
        );

        Route::bind(
            'user_skill',
            fn (string $value, Routing $route): Skill => Skill::query()
                ->where('user_id', $route->parameters['user'])
                ->where('id', $value)
                ->firstOrFail()
        );
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'))
        ;
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes()
    {
        Route::middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'))
        ;
    }
}
