<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function (\Illuminate\Http\Request $request) {
            // TODO 管理者ルーティングの場合
            if ($request->routeIs('manager_*')) {
                return route('manager_login');
            }

            // TODO ユーザーのログイン画面
            // return route('user_login');

        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
