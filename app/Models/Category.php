<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Category extends Model
{
    use HasFactory, AsSource, Attachable, Filterable;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'parent_id',
        'description',
        
    ];

    protected $allowedSorts = [
        'name',
        'created_at',
        'updated_at'
    ];

    protected $allowedFilters = [
        'name','created_at'
    ];

    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    public function children()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    public function scopeParentEmpty($query)
    {
        return $query->whereNull('parent_id')->orWhere('parent_id',0);
    }
}
