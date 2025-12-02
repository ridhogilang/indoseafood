<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailContact extends Model
{
    protected $table = 'email_contacts';

    protected $fillable = [
        'company',
        'main_product',
        'website',
        'kirim',
        'country',
        'phone',
        'whatsapp',
        'contact_person',
        'notes',
        'status',
        'is_campaign',
        'is_promotion'
    ];

    public function campaignEntries()
    {
        return $this->hasMany(\App\Models\EmailCampaignContact::class);
    }
}
