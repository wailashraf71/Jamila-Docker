<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['accepted'];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function products(){
        return $this->belongsToMany('App\Models\Product', 'order_products')->withPivot(["quantity"]);
    }

    protected $appends=['published', 'status'];

    public function getPublishedAttribute(){

        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']) )->format('Y/m/d');
    }

    public function getStatusAttribute(){

        return $this->accepted > 0 ? 'تمت الموافقة': 'قيد الانتظار';
    }
}
