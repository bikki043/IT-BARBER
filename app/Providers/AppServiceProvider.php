<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request; // เพิ่มตัวนี้เข้ามาด้วย

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. ตรวจสอบว่ารันผ่าน ngrok หรือไม่
        if (str_contains(request()->header('host'), 'ngrok-free.app')) {
            
            // 2. บังคับให้สร้าง URL ทุกอย่างเป็น https
            URL::forceScheme('https');

            // 3. ตั้งค่า Trusted Proxies เพื่อให้ Laravel ยอมรับ HTTPS จากท่อของ ngrok
            Request::setTrustedProxies(
                ['0.0.0.0/0', '2000::/3'], 
                Request::HEADER_X_FORWARDED_FOR | 
                Request::HEADER_X_FORWARDED_HOST | 
                Request::HEADER_X_FORWARDED_PORT | 
                Request::HEADER_X_FORWARDED_PROTO
            );
        }
    }
}