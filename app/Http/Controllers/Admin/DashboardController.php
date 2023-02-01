<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Kegiatan;
use DB;

class DashboardController extends Controller
{

    public function index(Bagian $bagian)
    {
        $menu = "Dashboard";
        // $bagian = Bagian::latest()->get();

        $kegiatan = Kegiatan::select('*')->selectRaw('SUM(pagu_kegiatan) as pagu')
            ->groupBy('bagian_id')
            ->get();
        // dd($kegiatan);
        return view('admin.dashboard', compact('menu', 'kegiatan'));
    }
}
