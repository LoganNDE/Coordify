<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        /*
        $exceptions->render(function (QueryException $e, Request $request) {
            if ($e->getCode() === '23000' && $request->isMethod('post')) {
                return redirect()->back()->with('error', 'Ese correo electrónico ya está en uso.');
            }

            // Deja que Laravel gestione otros errores normalmente
            return null;
        });

        $exceptions->render(function (\Throwable $e, Request $request) {
            // Solo intercepta si la petición es POST o AJAX
            if ($request->isMethod('post') || $request->expectsJson()) {
                return redirect()->back()->with('error', 'Ha ocurrido un error inesperado.');
            }

            // Para todo lo demás, que Laravel siga su flujo normal
            return null;
        });
        */

    })->create();
