<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class DataParser
{
    public function handle(Request $request, Closure $next)
    {
        $request->merge([
            'body' => $request->post(),
            'query' => $request->query(),
            'parameters' => $request->route()->parameters(),
        ]);

        return $next($request);
    }
}
