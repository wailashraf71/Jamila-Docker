<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertProduct extends Model
{
    use HasFactory;

    protected $fillable = array('advert_id', 'product_id');

}
