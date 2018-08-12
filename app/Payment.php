<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function booking()
    {
        return $this->hasOne(Order::class,'id','booking_id');
    }

    public function getBookingNameAttribute()
    {
        return $this->booking->booking_name;
    }

    public function getCustomerNameAttribute()
    {
        return $this->booking->customer->name;
    }


}
