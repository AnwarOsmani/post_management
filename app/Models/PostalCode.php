<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    protected $table = 'postal_codes';  // Specify the table name
    protected $primaryKey = 'postal_code';  // Primary key

    public $timestamps = false;  // Disable timestamps

    // Specify the columns that can be accessed
    protected $fillable = ['postal_code', 'district', 'post_office', 'province'];


    public function admins()
    {
        return $this->hasMany(Admin::class, 'postal_code');
    }

    public function workers()
    {
        return $this->hasMany(Worker::class, 'postal_code');
    }
}
