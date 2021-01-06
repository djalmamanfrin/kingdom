<?php

namespace App\Console;

use App\Console\Commands\CreateServicesIndexInElasticSearch;
use App\Console\Commands\ManualInsertionOfServiceInDatabaseCommand;
use App\Console\Commands\ManualInsertionOfServiceInElasticSearchCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ManualInsertionOfServiceInDatabaseCommand::class,
        ManualInsertionOfServiceInElasticSearchCommand::class,
        CreateServicesIndexInElasticSearch::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
