<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class CustomInput extends Model
{
    use HasFactory, AsSource, Attachable, Filterable;

    protected $fillable = [
        'name','label','description','video','image'
    ];

    public function video()
    {
        return $this->hasOne(Attachment::class,'id','video')->withDefault();
    }
}
