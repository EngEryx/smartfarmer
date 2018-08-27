<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    protected $casts = [
        'items' => 'array'
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class,'booking_id','id');
    }
    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function customer()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function getCustomerNameAttribute()
    {
        return $this->customer->name;
    }

    public function getProductNameAttribute()
    {
    }

    public function getPriceTextAttribute()
    {
    }

    public function getStatusTextAttribute()
    {
        switch ($this->status){
            case 1:
                return "<i class='label label-success'>Paid</i>";
            case 0:
                return "<i class='label label-danger'>Ordered</i>";
        }
        return '';
    }

    public function getViewUrlAttribute()
    {
        return route('frontend.order.view-pay', $this);
    }

    public function getBookingNameAttribute()
    {
        return $this->id.' '.$this->salonitem_name;
    }
}
