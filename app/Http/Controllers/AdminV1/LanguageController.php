<?php

namespace App\Http\Controllers\AdminV1;

use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    /**
     * @param $lang
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function swap($lang)
    {
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
