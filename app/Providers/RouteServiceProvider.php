<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $apiNameSpace = 'App\Http\Controllers\Api';

    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot( ) {
        $this -> configureRateLimiting( );
        // $this -> routes( fn ( ) : array => [
        //     Route:: prefix     ( 'api'                         )
        //         ->  middleware ( 'api'                         )
        //         ->  name       ( 'api.'                        )
        //         ->  namespace  ( $this->apiNameSpace              )
        //         ->  group      ( base_path( 'routes/api.php' ) )
        //     ,
        //     Route:: middleware ( 'web'                         )
        //         ->  namespace  ( $this->namespace              )
        //         ->  group      ( base_path( 'routes/web.php' ) )
        //     ,
        // ]);
        parent::boot();

    }
    public function map()
    {
        $this->mapDashboardApiRoutes();
        $this->mapApiRoutes();
        
        $this->mapWebRoutes();
    }
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }
    protected function mapDashboardApiRoutes()
    {
        Route::prefix('api/dashboard')
             ->middleware('api')
             ->namespace('App\Http\Controllers\Api\dashboard')
             ->group(base_path('routes/dashboard.php'));
    }
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace('App\Http\Controllers\Api\mobile')
             ->group(base_path('routes/api.php'));
    }
    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting( ) {
        RateLimiter::for( 'api' , fn ( Request $request ) => Limit::perMinute( 60 ) -> by( optional( $request -> user( ) ) -> id ?: $request -> ip( ) ) );
    }
}
