<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [];

    //protected function schedule(Schedule $schedule)
    //{
        // Schedule commands here
    //}

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
