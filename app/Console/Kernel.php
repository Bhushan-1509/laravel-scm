<?php

namespace App\Console;


use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
//use PragmaRX\Google2FA\Vendor\Laravel\Commands\GenerateSecretKey;


class Kernel extends ConsoleKernel
{
//    protected $commands = [
//        \PragmaRX\Google2FA\Vendor\Laravel\Commands\GenerateSecretKey::class,
//    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
