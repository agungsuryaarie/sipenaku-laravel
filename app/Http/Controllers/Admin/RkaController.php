<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Kegiatan;
use App\Models\Rekening;
use App\Models\RKA;
use App\Models\Subkegiatan;
use App\Models\TW;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RkaController extends Controller
{
    public function index(Request $request)
    {
        $menu = 'Rencana Kerja Anggaran';
        if ($request->ajax()) {
            $data = Bagian::where('nama_bagian', '!=', 'Admin Verifikator')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_bagian', function ($data) {
                    $link = '<a href="' . route('rka.kegiatan', Crypt::encryptString($data->id))  . '">' . $data->nama_bagian . '</a>';
                    return $link;
                })
                ->rawColumns(['nama_bagian'])
                ->make(true);
        }
        return view('admin.rka.bagian', compact('menu'));
    }

    public function kegiatan(Request $request, $id)
    {
        $menu = 'Rencana Kerja Anggaran';
        $bagian = Bagian::where('id', Crypt::decryptString($id))->first();
        if ($request->ajax()) {
            $data = Kegiatan::where('bagian_id', Crypt::decryptString($id))->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_kegiatan', function ($data) {
                    $link = '<a href="' . route('rka.subkegiatan', Crypt::encryptString($data->id))  . '">' . $data->kode_kegiatan;
                    $link = $link . ' ' . $data->nama_kegiatan . '</a>';
                    return $link;
                })
                ->rawColumns(['nama_kegiatan'])
                ->make(true);
        }
        return view('admin.rka.kegiatan', compact('menu', 'id', 'bagian'));
    }

    public function subkegiatan(Request $request, $id)
    {
        $menu = 'Rencana Kerja Anggaran';
        $kegiatan = Kegiatan::where('id', Crypt::decryptString($id))->first();
        if ($request->ajax()) {
            $data = Subkegiatan::where('kegiatan_id', Crypt::decryptString($id))->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_sub', function ($data) {
                    $link = '<a href="' . route('rka.rekening', Crypt::encryptString($data->id))  . '">' . $data->kode_sub;
                    $link = $link . ' ' . $data->nama_sub . '</a>';
                    return $link;
                })
                ->rawColumns(['nama_sub'])
                ->make(true);
        }
        return view('admin.rka.subkegiatan', compact('menu', 'id', 'kegiatan'));
    }

    public function rekening(Request $request, $id)
    {
        $menu = 'Rencana Kerja Anggaran';
        $subkegiatan = Subkegiatan::where('id', Crypt::decryptString($id))->first();
        $data = Rekening::with('rka')->where('subkegiatan_id', Crypt::decryptString($id))->latest()->get();
        dd($data->rka);
        if ($request->ajax()) {
            $data = Rekening::with('rka')->where('subkegiatan_id', Crypt::decryptString($id))->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_rekening', function ($data) {
                    $link = $data->kode_rekening . ' ' . $data->nama_rekening;
                    return $link;
                })
                ->addColumn('januari', function ($data) {
                    $link = $data->rka;
                })
                ->rawColumns(['nama_rekening'])
                ->make(true);
        }
        return view('admin.rka.rekening', compact('menu', 'id', 'subkegiatan'));
    }

    public function store(Request $request)
    {

        RKA::updateOrCreate(
            [
                'id' => $request->rka_id
            ],
            [
                'rekening_id' => $request->rekening_id,
                'january' => $request->january,
                'february' => $request->february,
                'march' => $request->march,
                'april' => $request->april,
                'may' => $request->may,
                'june' => $request->june,
                'july' => $request->july,
                'august' => $request->august,
                'september' => $request->september,
                'october' => $request->october,
                'november' => $request->november,
                'december' => $request->december,
            ]
        );

        return response()->json(['success' => 'RKA saved successfully.']);
    }
}
