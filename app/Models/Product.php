<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'product_type',
        'price',
        'special_price',
        'short_description',
        'status',
        'brand_id',
        'attributes',
        'description',
        
    ];

    public function bundleItems()
    {
        return $this->belongsToMany(Product::class,'product_bundles','bundle_id','product_id');
    }

    public function customInputs()
    {
        return $this->belongsToMany(CustomInput::class,'products_custom_inputs_pivot');
    }
}
