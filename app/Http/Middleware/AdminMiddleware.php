<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
         if (!Auth::check()) {
            // Ajout de journalisation pour surveiller les tentatives d'accès non autorisées.
             Log::warning('Accès non authentifié tenté.');
             return redirect()->route('login');
         }

         if (Auth::user()->role !== 'admin') {
             Log::warning('Accès interdit : utilisateur avec rôle ' . Auth::user()->role);
             abort(403, 'Action non autorisée. Accès administrateur requis.');
         }

         return $next($request);
    }
}
