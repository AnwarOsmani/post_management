<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryRequest extends Model
{

    protected $fillable = [
        'sender_name',
        'sender_phone',
        'sender_postal_code',
        'receiver_name',
        'receiver_phone',
        'receiver_postal_code',
        'user_id',
        'status',
        'assigned_worker',
    ];
    // Define status constants
    const STATUS_CREATED = 1;
    const STATUS_IN_POST_OFFICE = 2;
    const STATUS_ON_THE_WAY = 3;
    const STATUS_IN_RECEIVER_POST_OFFICE = 4;
    const STATUS_DELIVERED = 5;
    const STATUS_CLOSED = 6;

    public function getStatusLabel()
    {
        return match ($this->status) {
            self::STATUS_CREATED => 'Created',
            self::STATUS_IN_POST_OFFICE => 'In Post Office',
            self::STATUS_ON_THE_WAY => 'On the Way',
            self::STATUS_IN_RECEIVER_POST_OFFICE => 'In Receiver Post Office',
            self::STATUS_DELIVERED => 'Delivered',
            self::STATUS_CLOSED => 'Closed',
            default => 'Unknown',
        };
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function package()
    {
        return $this->hasOne(Package::class, 'request_id');
    }


    // Status update logic
    public function getNextStatus()
    {
        switch ($this->status) {
            case self::STATUS_CREATED:
                return self::STATUS_IN_POST_OFFICE;
            case self::STATUS_IN_POST_OFFICE:
                return self::STATUS_ON_THE_WAY;
            case self::STATUS_ON_THE_WAY:
                return self::STATUS_IN_RECEIVER_POST_OFFICE;
            case self::STATUS_IN_RECEIVER_POST_OFFICE:
                return self::STATUS_DELIVERED;
            default:
                return null; // Status closed
        }
    }
}
