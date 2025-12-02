<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailCampaign extends Model
{
    use HasFactory;

    protected $table = 'email_campaigns';

    protected $fillable = [
        'title',
        'subject',
        'body_html',
    ];

    public function contacts()
    {
        return $this->hasMany(\App\Models\EmailCampaignContact::class);
    }
}
