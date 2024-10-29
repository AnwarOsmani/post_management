<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends User
{
    protected $table = 'workers';
    public $timestamps = false;  // Disable timestamps

    protected $fillable = ['user_id', 'admin_id', 'postal_code'];

    // Each worker has one user account
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Each worker belongs to an admin
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function postalCode()
    {
        return $this->belongsTo(PostalCode::class, 'postal_code');
    }
}
