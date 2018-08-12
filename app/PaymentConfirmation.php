<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentConfirmation extends Model
{
//    use PaymentConfirmationRelationship,
//        PaymentConfirmationAttribute;

    protected $guarded = [];
    protected $casts = ['status' => 'boolean'];
}
