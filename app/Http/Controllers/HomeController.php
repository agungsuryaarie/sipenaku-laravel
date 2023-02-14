<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $appsetting = AppSetting::first();
        $visi = AppSetting::orderBy('visi', 'desc')->limit(3)->get();
        $misi = AppSetting::orderBy('misi', 'desc')->limit(3)->get();

        return view('index', compact(
            'appsetting',
            'misi',
            'visi'
        ));
    }
}
