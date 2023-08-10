<?php

namespace App\Console;

use App\Console\Commands\TestEmail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\App;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected $commands = [
        TestEmail::class,
    ];
    protected function schedule(Schedule $schedule)
    {
        if (App()->environment("production")) {
            $schedule->command('send:email test')->everyMinute();
        }
    }



    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        \App\Console\Commands\TestEmail::class;
        require base_path('routes/console.php');
    }
}
