<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCsrfToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Remova ou comente a verificação CSRF
        // return parent::handle($request, $next);

        return $next($request); // Ignora a verificação CSRF
    }

    protected $except = [
        'api/*', // Adicione sua rota API aqui, se necessário
    ];
}
