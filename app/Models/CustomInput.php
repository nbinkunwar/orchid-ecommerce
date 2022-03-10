<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class CustomInput extends Model
{
    use HasFactory, AsSource, Attachable;

    protected $fillable = [
        'name','label','description'
    ];
}
