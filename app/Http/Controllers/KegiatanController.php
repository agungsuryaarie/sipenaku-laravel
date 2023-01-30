<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Bagian;
use DataTables;

class KegiatanController extends Controller
{

    public function index(Request $request)
    {
        $menu = 'Daftar Kegiatan';
        $bagian = Bagian::latest()->get();
        if ($request->ajax()) {
            $data = Kegiatan::with('bagian')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('kode_kegiatan', function ($data) {
                    $link = '<a href="' . route('subkegiatan.index', $data->id)  . '">' . $data->kode_kegiatan . '</a>';
                    return $link;
                })
                ->addColumn('nama_kegiatan', function ($data) {
                    $link = '<a href="' . route('subkegiatan.index', $data->id)  . '">' . $data->nama_kegiatan . '</a>';
                    return $link;
                })
                ->addColumn('bagian', function ($data) {
                    return $data->bagian->nama_bagian;
                })
                ->addColumn('pagu_kegiatan', function ($data) {
                    if ($data->pagu_kegiatan == "") {
                        $link = "Rp. " . "0";
                    } else {
                        $link = 'Rp. ' . number_format($data->pagu_kegiatan, 0, ',', '.');
                    }
                    return $link;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-xs editKegiatan"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs deleteKegiatan"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['kode_kegiatan', 'nama_kegiatan', 'bagian', 'pagu_kegiatan', 'action'])
                ->make(true);
        }
        return view('admin.kegiatan.data', compact('menu', 'bagian'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'kode_kegiatan' => 'required',
            'nama_kegiatan' => 'required',
            'bagian_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        Kegiatan::updateOrCreate(
            [
                'id' => $request->kegiatan_id
            ],
            [
                'kode_kegiatan' => $request->kode_kegiatan,
                'nama_kegiatan' => $request->nama_kegiatan,
                'bagian_id' => $request->bagian_id,
            ]
        );

        return response()->json(['success' => 'Kegiatan saved successfully.']);
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::find($id);
        return response()->json($kegiatan);
    }

    public function destroy($id)
    {
        Kegiatan::find($id)->delete();
        return response()->json(['success' => 'Kegiatan deleted successfully.']);
    }
}
