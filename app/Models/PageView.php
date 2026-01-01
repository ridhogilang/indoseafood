<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = ['date', 'views'];

    protected $casts = [
        'date' => 'date',
    ];
}
