<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory, AsSource, Attachable,Filterable;

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

    protected $casts = [
        'attributes'=>'array'
    ];

    protected $allowedSorts = [
        'name',
        'price',
        'product_type',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $allowedFilters = [
        'name','price','created_at','updated_at','product_type','status'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class,'products_categories_pivot');
    }

    public function bundleItems()
    {
        return $this->belongsToMany(Product::class,'product_bundles','bundle_id','product_id');
    }

    public function customInputs()
    {
        return $this->belongsToMany(CustomInput::class,'products_custom_inputs_pivot');
    }

    public function scopeActive($query)
    {
        return $query->where('status','active');
    }

    public function scopeBundleable($query)
    {
        return $query->active()->where('product_type','!=','bundle');
    }
}
