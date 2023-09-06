<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products_item extends Model
{
    use HasFactory;
    protected $guarded=[];
public function products ()
{
    return $this->belongsTo(products::class,'product_id');
}
public function items(){
    return $this->belongsTo(item::class,'item_id');
}
}
