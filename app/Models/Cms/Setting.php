<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_description',
        'logo',
        'favicon',
        'office_address',
        'facebook',
        'instagram',
        'telegram',
        'telegram_channel',
        'whatsapp',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * Tampilkan nomor WhatsApp dalam format lokal (awalan 0)
     */
    public function getWhatsappFormattedAttribute()
    {
        return preg_replace('/^62/', '0', $this->whatsapp);
    }
}
