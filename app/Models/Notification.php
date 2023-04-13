<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'notification_message',
        'notification_redirect',
        'car_id',
        'is_read',
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }
}
