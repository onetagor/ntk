<?php

namespace App\Http\View\Composers;

use App\Models\SiteSetting;
use Illuminate\View\View;

class SiteSettingComposer
{
    public function compose(View $view)
    {
        $siteSetting = SiteSetting::first();
        $view->with('siteSetting', $siteSetting);
    }
}
