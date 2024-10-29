<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Package extends Model
{
    use HasFactory;

    protected $fillable = ['request_id', 'weight', 'price', 'tracking_number'];

    // Define the relationship with Request model

    public function deliveryRequest()
    {
        return $this->belongsTo(DeliveryRequest::class, 'request_id');
    }
}
