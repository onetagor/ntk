<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_logo',
        'business_id',
        'phone',
        'phone_2',
        'email',
        'address',
        'contact_person_1',
        'contact_person_2',
        'working_hours',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'youtube_url',
        'about_description',
        'about_image',
        'footer_text',
    ];
}
