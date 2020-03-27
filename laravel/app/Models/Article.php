<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'image', 'description', 'created_by', 'confirmed'
    ];

    protected $table = 'articles';
}
