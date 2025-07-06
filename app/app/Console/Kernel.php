<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Http\Controllers\TransactionhookController;
use App\Http\Controllers\NotifyCandidates;
use App\Http\Controllers\NotifyEmployers;
use App\Http\Controllers\PagesController;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log; // Add this line
use App\Http\Livewire\DeleteAccount;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            (new TransactionhookController)->add_transaction();
        })->daily();

        $schedule->call(function () {
            (new TransactionhookController)->update_transaction_after_tenmin();
        })->everyFiveMinutes();

        /*$schedule->call(function () {
            (new NotifyCandidates)->send_notification();
        })->daily();*/

        $schedule->call(function () {
            (new TransactionhookController)->cancel_yearly_subscription();
        })->daily();

        $schedule->call(function () {
            (new NotifyEmployers)->send_notification();
        })->dailyAt('08:00');

        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run')->daily()->at('2:00');

        $schedule->call(function () {
            (new PagesController)->reminderEmailToCandidate();
        })->hourly();

        $schedule->call(function () {
            (new PagesController)->reminderEmailToCandidate3Days();
        })->hourly();

        $schedule->call(function () {
            Log::info('Executing add_transaction task.');
            (new PagesController)->reminderEmailToCandidate6Days();
        })->hourly();

                // restrict deleted employer to use account
                $schedule->call(function () {
                    (new DeleteAccount)->restrictDeletedAccount();
                })->dailyAt('00:00');

        /*$schedule->call(function () {
            (new TransactionhookController)->test_cron();
        })->everyMinute();*/

        // update charges
        $schedule->call(function () {
            (new PagesController)->updateCharges();
        })->hourly();
         // new match search
         $schedule->call(function () {
            (new PagesController)->searchNewMatch();
        })->hourly();
        $schedule->call(function () {
            (new PagesController)->searchMatchUser();
        })->hourly();
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
