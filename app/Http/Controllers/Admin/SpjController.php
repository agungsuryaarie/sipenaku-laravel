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
        $menu = 'SPJ';
        return view('admin.spj.data', compact('menu'));
    }
    public function indexadm(Request $request)
    {
        $menu = 'Data SPJ';
        return view('admin.spj.data-admin', compact('menu'));
    }

    public function create()
    {
        $menu = 'Tambah SPJ';
        return view('admin.spj.create', compact('menu'));
    }
}
