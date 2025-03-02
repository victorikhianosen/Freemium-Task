<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_cv',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
