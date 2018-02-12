<?php
namespace App\Http\Middleware;

use Closure;

class XSSFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!in_array(strtoupper($request->method(), ['PUT', 'POST']))) {
            return $next[$request];
        }

        $input = $request->all();

        array_walk_recursive($input, function(&$input) {
            if (is_string($input)) $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        });

        $request->merge($input);

        return $next[$request];
    }
}
