<?php

namespace App\Observers;

use App\Models\Notification;

class NotificationObserver
{
    /**
     * Handle the Notification "created" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function created(Notification $notification)
    {
        if(config('laravel-fcm.server_key') && $notification->notifiable->fcm_device_id) {
            $recipients = [$notification->notifiable->fcm_device_id];

            fcm()
                ->to($recipients)
                ->priority('high')
                ->timeToLive(0)
                ->data([
                    'title' => $notification->title,
                    'body' => $notification->notification_message,
                ])
                ->notification([
                    'title' => $notification->title,
                    'body' => $notification->notification_message,
                ])
                ->send();
        }
    }
}
