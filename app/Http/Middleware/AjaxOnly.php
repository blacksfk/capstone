<?php

namespace App\Http\Middleware;

use Closure;

class AjaxOnly
{
    /**
     * Handle an incoming request.
     * This middlware prevents access to routes which are accessed synchronously
     * For routes you don't want to be accessed synchronously,
     * put it in the route:
     * Route::get("some_url", ["middleware" => "ajax"], SomeController@somemethod);
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->ajax())
        {
            return response("Forbidden.", 403);
        }

        return $next($request);
    }
}
