<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // 1. CSRF (คงเดิมของคุณ)
        $middleware->validateCsrfTokens(except: [
            'booking/store',
            'book/store',
            '/booking/store',
            'checkout/payment*',
            'checkout/process-payment',
        ]);

        // 2. บังคับจุด Redirect (รวมเงื่อนไขให้จบในที่เดียว)
        $middleware->redirectTo(
            // กรณีเป็น Guest (ยังไม่ได้ล็อกอิน หรือเพิ่ง Logout)
            guests: function (Request $request) {
                // ถ้าพยายามเข้าหน้า Admin ให้ไป /login (AdminLTE)
                if ($request->is('admin') || $request->is('admin/*')) {
                    return '/login';
                }
                // นอกนั้นทั้งหมด (รวมถึงหลัง Logout จากหน้า Profile) ให้กลับหน้า Welcome
                return '/'; 
            },
            
            // กรณีที่ล็อกอินแล้ว (กันพลาดถ้าใครพยายามเข้าหน้า Login ซ้ำ)
            users: function () {
                $user = \Illuminate\Support\Facades\Auth::user();
                if ($user && $user->role === 'admin') {
                    return '/admin/dashboard';
                }
                return '/';
            }
        );

        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();