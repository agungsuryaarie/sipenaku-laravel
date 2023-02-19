<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\SPJ;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Models\AppSetting;
use DB;

class DashboardController extends Controller
{

    public function index()
    {
        $menu = "Dashboard";
        $gu = Setting::first();
        $idb = Auth::user()->bagian_id;
        $bagian = Bagian::count();
        $user = User::count();
        $kegiatan_all = Kegiatan::count();
        $spj = SPJ::count();
        $spj_terima = SPJ::where('status', 2)->where('bagian_id', $idb)->count();
        $spj_tolak = SPJ::where('status', 4)->where('bagian_id', $idb)->count();
        $app = AppSetting::first();
        $kegiatan = Kegiatan::select('*')->selectRaw('SUM(pagu_kegiatan) as pagu')
            ->where('bagian_id', $idb)
            ->get();
        return view('admin.dashboard', compact('menu', 'kegiatan', 'gu', 'bagian', 'user', 'kegiatan_all', 'spj', 'app', 'spj_terima', 'spj_tolak'));
    }
}
