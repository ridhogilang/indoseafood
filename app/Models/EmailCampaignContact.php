<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailCampaignContact extends Model
{
    protected $fillable = [
        'email_campaign_id',
        'email_contact_id',
        'status',
        'sent_at',
    ];

    public function campaign()
    {
        return $this->belongsTo(\App\Models\EmailCampaign::class, 'email_campaign_id');
    }

    public function contact()
    {
        return $this->belongsTo(\App\Models\EmailContact::class, 'email_contact_id');
    }
}
