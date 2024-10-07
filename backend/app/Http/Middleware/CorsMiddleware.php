<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
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
        // Adicionar cabeçalhos de CORS
        $headers = [
            'Access-Control-Allow-Origin'      => 'http://localhost:3000',  // Domínio permitido
            'Access-Control-Allow-Methods'     => 'GET, POST, PUT, DELETE, OPTIONS',  // Métodos permitidos
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With',  // Cabeçalhos permitidos
        ];

        // Responder diretamente às requisições OPTIONS
        if ($request->getMethod() === 'OPTIONS') {
            return response()->json('OK', 200, $headers);
        }

        // Passar para o próximo middleware e adicionar os cabeçalhos à resposta
        $response = $next($request);

        foreach ($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}
