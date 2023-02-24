<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SPJ;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use Illuminate\Support\Facades\Auth;
use App\Models\Rekening;
use Illuminate\Support\Facades\Hash;
use DataTables;

class KartuController extends Controller
{
    public function index(Request $request)
    {
        $menu = 'Kartu Kendali';
        return view('admin.kartukendali.data', compact('menu'));
    }
    public function kegiatan(Request $request)
    {
        $menu = 'Kartu Kendali';
        if ($request->ajax()) {
            $data = Kegiatan::where('bagian_id', Auth::user()->bagian_id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('kode_kegiatan', function ($data) {
                    $link = '<a href="' . route('kartukendali.subkeg', $data->id)  . '">' . $data->kode_kegiatan . '</a>';
                    return $link;
                })
                ->addColumn('nama_kegiatan', function ($data) {
                    $link = '<a href="' . route('kartukendali.subkeg', $data->id)  . '">' . $data->nama_kegiatan . '</a>';
                    return $link;
                })
                ->addColumn('pagu_kegiatan', function ($data) {
                    if ($data->pagu_kegiatan == "") {
                        $link = "Rp. " . "0";
                    } else {
                        $link = 'Rp. ' . number_format($data->pagu_kegiatan, 0, ',', '.');
                    }
                    return $link;
                })
                ->addColumn('sisa_kegiatan', function ($data) {
                    if ($data->sisa_kegiatan == "") {
                        $link = '<span
                        class="description-text text-danger">Rp. ' . "0" . '</span>';
                    } else {
                        $link = '<span
                        class="description-text text-danger">Rp. ' . number_format($data->sisa_kegiatan, 0, ',', '.') . '</pan>';
                    }
                    return $link;
                })
                ->rawColumns(['kode_kegiatan', 'nama_kegiatan', 'sisa_kegiatan'])
                ->make(true);
        }
        return view('admin.kartukendali.keg', compact('menu'));
    }
    public function subkeg(Request $request, $id)
    {
        $menu = 'Sub Kegiatan';
        $kegiatan = Kegiatan::where('id', $id)->first();
        if ($request->ajax()) {
            $data = Subkegiatan::with('rekening')->where('kegiatan_id', $id)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('kode_subkeg', function ($data) {
                    $link = '<a href="' . route('kartukendali.rek', $data->id)  . '">' . $data->kode_sub . '</a>';
                    return $link;
                })
                ->addColumn('nama_subkeg', function ($data) {
                    $link = '<a href="' . route('kartukendali.rek', $data->id)  . '">' . $data->nama_sub . '</a>';
                    return $link;
                })
                ->addColumn('pagu_sub', function ($data) {
                    if ($data->pagu_sub == "") {
                        $link = "Rp. " . "0";
                    } else {
                        $link = 'Rp. ' . number_format($data->pagu_sub, 0, ',', '.');
                    }
                    return $link;
                })
                ->addColumn('sisa_sub', function ($data) {
                    if ($data->sisa_sub == "") {
                        $link = '<span
                        class="description-text text-danger">Rp. ' . "0" . '</span>';
                    } else {
                        $link = '<span
                        class="description-text text-danger">Rp. ' . number_format($data->sisa_sub, 0, ',', '.') . '</span>';
                    }
                    return $link;
                })
                ->rawColumns(['kode_subkeg', 'nama_subkeg', 'sisa_sub'])
                ->make(true);
        }

        return view('admin.kartukendali.subkeg', compact('menu', 'id', 'kegiatan'));
    }
    public function rek(Request $request, $id)
    {
        $menu = 'Rekening';
        $subkegiatan = Subkegiatan::where('id', $id)->first();
        if ($request->ajax()) {
            $data = Rekening::where('subkegiatan_id', $id)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('kode_rekening', function ($data) {
                    $link = $data->kode_rekening;
                    return $link;
                })
                ->addColumn('nama_rekening', function ($data) {
                    $link = $data->nama_rekening;
                    return $link;
                })
                ->addColumn('pagu_rekening', function ($data) {
                    $link = 'Rp. ' . number_format($data->pagu_rekening, 0, ',', '.');
                    return $link;
                })
                ->addColumn('sisa_rekening', function ($data) {
                    $link = '<span
                    class="description-text text-danger">Rp. ' . number_format($data->sisa_rekening, 0, ',', '.') . '</span>';
                    return $link;
                })
                ->rawColumns(['sisa_rekening'])
                ->make(true);
        }
        return view('admin.kartukendali.rek', compact('menu', 'id', 'subkegiatan'));
    }
}
