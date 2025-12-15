<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'company_name',
        'email',
        'whatsapp',
        'phone',
        'fish_name',
        'latin_name',
        'freezing_method',
        'size',
        'qty',
        'port_of_destination',
        'note',
        'status',
        'is_arsip',
    ];
}
