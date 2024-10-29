<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Admin extends User
{
    protected $table = 'admins';
    public $timestamps = false;  // Disable timestamps

    protected $fillable = ['user_id', 'postal_code'];

    // Each admin has one user account
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // Each admin has many workers

    public function findWorkerById($id)
    {
        return $this->workers()->where('id', $id)->first();
    }

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }




    public function postalCode()
    {
        return $this->belongsTo(PostalCode::class, 'postal_code');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
