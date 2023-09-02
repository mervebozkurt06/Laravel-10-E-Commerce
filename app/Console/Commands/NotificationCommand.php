<?php

namespace App\Console\Commands;

use App\Mail\OldNotificationDeleted;
use App\Models\Notification as NotificationModel;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\NotificationDeletedNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class NotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleted Old Notification and Sent Info mail and notification to all users';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        NotificationModel::query()->where('created_at', '<', Carbon::now()->subDays(30))->delete();

        $users = User::all();
        foreach ($users as $user)
        {
            Mail::to($user)->send(new OldNotificationDeleted($user));
            Notification::send($user, new NotificationDeletedNotification());
        }


        $this->info('Successfully sent info to everyone.');
    }
}
