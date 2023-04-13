<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Product;
use App\Traits\HasApiResponse;

class NotificationController extends Controller
{
    use HasApiResponse;

    public function notificationRedirect($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update([
            'is_read' => true
        ]);

        return redirect($notification->notification_redirect);
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update([
            'is_read' => false
        ]);

        return redirect()->back();
    }
    
    public function markAllAsRead()
    {
        $portal = \Illuminate\Support\Arr::first(explode('.', request()->getHost()));
        $userid = request()->user($portal.'s_web')->id;
        $notifications = Notification::where('notifiable_id', $userid)->get();
        if(count($notifications) > 0) {
            foreach($notifications as $notification) {
                $notification->update([
                    'is_read' => true
                ]);
            }
        }

        return response()->json(['data' => 'success']);
    }

    public function apiNotificationList($limit = null)
    {
        $user = request()->user();
        if ($limit) {
            $notifications = $user->notifications()->desc()->take($limit)->get();
        } else {
            $notifications = $user->notifications()->desc()->paginate(request()->per_page);
        }

        foreach ($notifications as $key => $noti) {
            $product = Product::findOrFail($noti->car_id);
            $notifications[$key]['car_image'] = $product->front_image;
        }

        return $this->apiSuccess($notifications);
    }

    public function apiMarkAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update([
            'is_read' => true
        ]);

        return $this->apiUpdated(true);
    }

    public function apiMarkAllAsRead()
    {
        Notification::where('is_read', false)->update([
            'is_read' => true
        ]);

        return $this->apiUpdated(true);
    }

    public function apiUpdateFcmDevice()
    {
        request()->validate([
            'fcm_device_id' => "required"
        ]);

        $user = request()->user();

        $user->update([
            'fcm_device_id' => request()->fcm_device_id
        ]);

        return $this->apiUpdated(true);
    }
}
