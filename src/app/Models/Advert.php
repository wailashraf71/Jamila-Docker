<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;

    protected $fillable = array('title', 'image');

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'advert_products');
    }
}
