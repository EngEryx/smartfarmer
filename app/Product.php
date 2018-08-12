<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function getItemTypeTextAttribute()
    {
        if($this->item_type==1)
            return "Agro-Chemicals";
        return "Seeds";
    }

    public function getPriceTextAttribute()
    {
        return sprintf('Ksh%s',$this->cost);
    }

    public function getPurchaseUrlAttribute()
    {
        return '<a href="'.route('frontend.order.new', $this).'" class="btn btn-light btn-xs book-btn pull-right">Buy Now</a>';
    }

    public function getCheckoutUrlAttribute()
    {
        return '<a href="'.route('frontend.order.new-confirm', $this).'" class="btn btn-success btn-lg book-btn pull-right">Proceed to Buy >></a>';
    }
}
