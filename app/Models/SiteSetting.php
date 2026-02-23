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
        'phone',
        'email',
        'address',
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
