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
        return '<a href="'.route('frontend.order.new', $this).'" class="btn btn-light btn-xs book-btn pull-right">View</a>';
    }

    public function getCheckoutUrlAttribute()
    {
        return '<a href="'.route('frontend.order.new-confirm', $this).'" class="btn btn-success btn-lg book-btn pull-right">Proceed to Buy >></a>';
    }

    public function getDeleteBtnAttribute()
    {
        return '<a href="#" onclick="deleteProduct('.$this->id.',\''.route("admin.products.delete", $this).'\')" class="btn btn-danger btn-xs book-btn"> Delete </a>';
    }

    public function getEditItemAttribute()
    {
        return '<a href="'.route('admin.products.edit', $this).'" class="btn btn-primary btn-xs"> Edit </a>';
    }

    public function getActionButtonsAttribute()
    {
        return $this->getEditItemAttribute()
            .$this->getDeleteBtnAttribute();
    }
}
