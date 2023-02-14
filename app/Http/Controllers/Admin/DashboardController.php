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

    public function index()
    {
        $gu = Setting::first();
        $idb = Auth::user()->bagian_id;
        $menu = "Dashboard";
        $kegiatan = Kegiatan::select('*')->selectRaw('SUM(pagu_kegiatan) as pagu')
            ->where('bagian_id', $idb)
            ->get();
        return view('admin.dashboard', compact('menu', 'kegiatan', 'gu'));
    }
}
