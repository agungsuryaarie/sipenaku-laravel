<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spj;
use DataTables;

class SpjController extends Controller
{

    public function index(Request $request)
    {
        $menu = 'Profil'; {
        }

        return view('admin.spj.data', compact('menu'));
    }

    public function create()
    {
        $menu = 'Profil'; {
        }

        return view('admin.spj.create', compact('menu'));
    }
}
