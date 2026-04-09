<?php

namespace App\Http\Controllers\AdminV1;

use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function switchLanguage($lang)
    {
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
