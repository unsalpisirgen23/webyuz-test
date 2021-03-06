<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/admin';

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
    public function boot()
    {

        $this->configureRateLimiting();
        $this->routes(function () {

            Route::group(
                ['middleware'=>"web"]
                ,base_path('routes/auth.php'));

            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(function (){

                    Route::group(['middleware'=>"web"],base_path('routes/web.php'));



                    /**
                     * Admin Routes Folder index.php
                     */
                    Route::middleware('auth')
                        ->namespace($this->namespace)
                        ->prefix("/admin")
                        ->group(function (){


                            Route::group(["as"=>"admin."],base_path('routes/admin.php'));



                            if (Schema::hasTable("modules")){
                                $isModule = DB::table("modules")
                                    ->where("module_status","=",1)
                                    ->where("module_install","=",1)
                                    ->get();
                                if ($isModule->count() > 0)
                                {
                                    foreach ($isModule as $module)
                                    {
                                        Route::group(['prefix'=>"/module/".$module->module_namespace."","middleware"=>"auth",'as'=>"modules.".$module->module_namespace."."],base_path("Modules")."/".ucwords($module->module_name)."/routes/admin.php");
                                    }
                                }
                            }
                        });
                });
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
