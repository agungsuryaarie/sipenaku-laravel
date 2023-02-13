<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $appsetting = AppSetting::first();


        return view('index', compact(
            'appsetting'
        ));
    }
}
