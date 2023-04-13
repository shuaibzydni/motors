<?php

namespace App\Models;

use App\Models\Views\ProductView;
use App\Traits\QueryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class Buyer extends Authenticatable
{
    use HasFactory, HasApiTokens, QueryScope, Notifiable, Billable;

    const ROLE = "buyer";

    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "password",
        "avatar_path",
        "business_name",
        "business_phone",
        "business_email",
        "business_registration_document",
        "abn",
        "buyer_license_no",
        "address_line",
        "location_id",
        "postal_code",
        "google_id",
        "fb_id",
        "otp",
        "fcm_device_id",
    ];

    protected $hidden = ["password", "remember_token", "avatar_path"];

    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    protected $appends = ["avatar", "my_fav_ids", "notification_count", "subscription_status"];

    public function role()
    {
        return self::ROLE;
    }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes["password"] = bcrypt($value);
        }
    }

    public function getAvatarAttribute()
    {
        if ($this->avatar_path) {
            return Storage::disk("buyersPublic")->url($this->avatar_path);
        }

        return asset("images/unknown.png");
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function favourites()
    {
        return $this->morphToMany(ProductView::class, 'favouritable', 'favourites', null, 'product_id');
    }

    public function getMyFavIdsAttribute()
    {
        $favourites = $this->favourites()->get();
        if ($favourites->count() > 0) {
            return $favourites->pluck('id')->toArray();
        } else {
            return [];
        }
    }

    public function getNotificationCountAttribute()
    {
        return $this->notifications()->unread()->count();
    }

    public function getSubscriptionStatusAttribute()
    {
        $status = 'expired';
        $limit = 0;
        $message = 'You don\'t have any active plan';

        if ($this->currentSubscriptionPlan()) {
            if (!$this->currentSubscriptionPlan()->ends_at->isFuture() || $this->subscriptionPlanLimit() < 1) {
                $message = 'You subscription limit is over or expired!';
            } else {
                $status = 'active';
                $limit = $this->subscriptionPlanLimit();
                $message = 'You already have a active plan!';
            }
        }

        return collect([
            "status" => $status,
            "limit" => $limit,
            'message' => $message,
            "current_subscription" => $this->currentSubscriptionPlan(),
        ]);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function subscriptions()
    {
        return $this->morphMany(Subscription::class, 'usertable')->latest();
    }

    public function biddings()
    {
        return $this->hasMany(Bidding::class);
    }

    public function currentSubscriptionPlan()
    {
        if ($this->subscriptions()) {
            return $this->subscriptions()->first();
        }

        return null;
    }

    public function subscriptionPlanLimit()
    {
        $limit = 0;

        if ($this->currentSubscriptionPlan()) {
            $plan = $this->currentSubscriptionPlan();
            $carsCount = $this->biddings()->whereBetween('created_at', [$plan->created_at, $plan->ends_at])->count();
            $planLimit = $plan->quantity;

            $limit = $planLimit - $carsCount;
        }

        return $limit;
    }
}
