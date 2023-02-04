<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

class SpjController extends Controller
{

    public function index(Request $request)
    {
        $menu = 'Profil';
        if ($request->ajax()) {
            $data = Spj::latest()->get();
        }

        return view('admin.spj.data', compact('menu'));
    }
}
