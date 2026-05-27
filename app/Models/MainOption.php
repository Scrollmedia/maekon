<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelLang\Models\HasTranslations;


class MainOption extends Model
{  
 
    protected $fillable = ['id', 'name', 'content'];
 
    protected $casts = [
        'content' => 'array',
    ];
}
