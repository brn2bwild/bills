<?php

use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
	->withRouting(
		// web: __DIR__.'/../routes/web.php',
		// api: __DIR__.'/../routes/v1/api.php',
		commands: __DIR__ . '/../routes/console.php',
		health: '/up',
		then: function () {
			Route::middleware('api')
				->prefix('api/v1')
				->group(base_path('routes/api/v1/api.php'));
		}
	)
	->withMiddleware(function (Middleware $middleware) {
		// $middleware->append(ForceJsonResponse::class);
		$middleware->api([
			'throttle:api',
			ForceJsonResponse::class,
		]);
	})
	->withExceptions(function (Exceptions $exceptions) {
		//
	})->create();
