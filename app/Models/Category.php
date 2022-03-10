<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Category extends Model
{
    use HasFactory, AsSource, Attachable;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'parent_id',
        'description',
        
    ];

    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id');
    }
}
