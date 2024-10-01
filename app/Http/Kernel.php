<?php  

namespace App\Http;  

use Illuminate\Foundation\Http\Kernel as HttpKernel;  

class Kernel extends HttpKernel  
{  
    /**  
     * The application's global HTTP middleware stack.  
     *  
     * @var array  
     */  
    protected $middleware = [  
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,  
        \Illuminate\Routing\Middleware\SubstituteBindings::class,  
    ];  

    /**  
     * The application's route middleware.  
     *  
     * These middleware may be assigned to groups or used individually.  
     *  
     * @var array  
     */  
    protected $routeMiddleware = [  
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,  
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,  
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,  
        'can' => \Illuminate\Auth\Middleware\Authorize::class,  
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,  
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,  
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,  
        'sanctum' => \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,  
        // Add any custom middleware here  
    ];  

    /**  
     * The application's middleware groups.  
     *  
     * Aliases for various middleware groups that can be applied to routes.  
     *  
     * @var array  
     */  
    protected $middlewareGroups = [  
        'web' => [  
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,  
            \Illuminate\Session\Middleware\StartSession::class,  
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,  
            \Illuminate\Routing\Middleware\SubstituteBindings::class,  
        ],  

        'api' => [  
        
                \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,  
                'throttle:api',  
                \Illuminate\Routing\Middleware\SubstituteBindings::class,  
       
        ],  
    ];  
}