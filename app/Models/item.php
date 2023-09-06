<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function products()
{
    return $this->hasMany(products_item::class);
}
}
