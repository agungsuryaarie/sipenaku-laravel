<?php

namespace App\Http\Controllers;

use App\Models\Subkegiatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use DataTables;

class SubkegiatanController extends Controller
{
    public function index(Request $request, $id)
    {
        $menu = 'Daftar Sub Kegiatan';
        $id = $id;
        $kegiatan = Kegiatan::where('id', $id)->first();
        $subkegiatan = Subkegiatan::where('kegiatan_id', $id)->first();
        if ($request->ajax()) {
            $data = Subkegiatan::with('kegiatan')->where('kegiatan_id', $id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('kode_subkeg', function ($data) {
                    $link = '<a href="' . route('rekening.index', $data->id)  . '">' . $data->kode_sub . '</a>';
                    return $link;
                })
                ->addColumn('nama_subkeg', function ($data) {
                    $link = '<a href="' . route('rekening.index', $data->id)  . '">' . $data->nama_sub . '</a>';
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
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-xs editSubkeg"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs deleteSubkeg"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['kode_subkeg', 'nama_subkeg', 'pagu_sub', 'action'])
                ->make(true);
        }

        return view('admin.sub-kegiatan.data', compact('menu', 'id', 'kegiatan', 'subkegiatan'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'kegiatan_id' => 'required|numeric',
            'kode_sub' => 'required',
            'nama_sub' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        Subkegiatan::updateOrCreate(
            [
                'id' => $request->subkeg_id
            ],
            [
                'kegiatan_id' => $request->kegiatan_id,
                'kode_sub' => $request->kode_sub,
                'nama_sub' => $request->nama_sub,
            ]
        );

        return response()->json(['success' => 'Sub Kegiatan saved successfully.']);
    }

    public function edit($kegiatan_id, $id)
    {
        $subkeg = Subkegiatan::find($id);
        return response()->json($subkeg);
    }

    public function destroy($id)
    {
        Subkegiatan::find($id)->delete();
        return response()->json(['success' => 'Sub Kegiatan deleted successfully.']);
    }
}
