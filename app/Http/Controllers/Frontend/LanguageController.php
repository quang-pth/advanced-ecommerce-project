<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class LanguageController extends Controller
{
    public function renderVietnamese() {
        session()->get('language'); // return language as string
        session()->forget('language');
//        set new language
        Session::put('language', 'vietnamese');
        return redirect()->back();
    }

    public function renderEnglish() {
        session()->get('language');
        session()->forget('language');
//        set new language
        Session::put('language', 'english');
        return redirect()->back();
    }
}
