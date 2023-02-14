<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use DB;

class DashboardController extends Controller
{

    public function index(Bagian $bagian)
    {
        $id_bagian = Auth::user()->bagian_id;
        $menu = "Dashboard";
        $kegiatan = Kegiatan::select('*')->selectRaw('SUM(pagu_kegiatan) as pagu')
            ->where('bagian_id', $id_bagian)
            ->get();
        // dd($kegiatan);
        return view('admin.dashboard', compact('menu', 'kegiatan'));
    }
}
