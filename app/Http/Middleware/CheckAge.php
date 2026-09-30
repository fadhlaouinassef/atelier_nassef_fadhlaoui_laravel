<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $age = $request->query('age');

        if (! is_scalar($age) || ! ctype_digit((string) $age) || (int) $age > 120) {
            abort(422, 'Le paramètre age doit être un entier entre 0 et 120.');
        }

        if ((int) $age <= 18) {
            return redirect()->route('acces-refuse');
        }

        return $next($request);
    }
}
