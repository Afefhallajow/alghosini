<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function items()
     {
        return $this->hasMany(products_item::class,'product_id');
    }

}
