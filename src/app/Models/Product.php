<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Product extends Model
{
    use HasFactory, LaravelVueDatatableTrait;

    protected $fillable = array('title', 'image', 'description', 'sku', 'quantity', 'price', 'box_items');
    protected $casts = [
        'price' => 'float',
    ];

    protected $dataTableColumns = [
        'id' => [
            'searchable' => false,
        ],
        'title' => [
            'searchable' => true,
        ],
        'sku' => [
            'searchable' => true,
        ],
        'description' => [
            'searchable' => true,
        ]
    ];

    public function category()
    {
        return $this->belongsToMany('App\Models\Category', 'category_products');
    }

}
