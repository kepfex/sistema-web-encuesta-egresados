<?php

namespace App\Http\Middleware;

use App\Models\TemporaryLink;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateSurveyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->route('token');
        
        // 1. Busca el enlace en la base de datos
        $link = TemporaryLink::where('token', $token)->first();

        // 2. Si no existe, muestra un error 404 (No Encontrado)
        if (!$link) {
            abort(404);
        }

        // 3. Si no está activo, muestra un error 403 (Prohibido)
        if (!$link->esta_activo) {
            abort(403, 'Este enlace de encuesta ha sido desactivado.');
        }

        // 4. Si tiene fecha de expiración y ya pasó, muestra un error 403
        if ($link->fecha_expiracion && $link->fecha_expiracion->isPast()) {
            abort(403, 'Este enlace de encuesta ha expirado.');
        }

        // 5. Si tiene límite de usos y ya se alcanzó, muestra un error 403
        if ($link->maximo_usos > 0 && $link->usos_actuales >= $link->maximo_usos) {
            abort(403, 'Este enlace ha alcanzado el número máximo de respuestas.');
        }

        // Si todas las validaciones pasan, permite que la petición continúe
        return $next($request);
    }
}
