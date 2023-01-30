<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subkegiatan;
use App\Models\Rekening;
use App\Models\Detail;
use Illuminate\Http\Request;
use DataTables;

class RekeningController extends Controller
{
    public function index(Request $request, $id)
    {
        $menu = 'Daftar Rekening';
        $id = $id;
        $subkegiatan = Subkegiatan::where('id', $id)->first();
        $rekening = Rekening::where('subkegiatan_id', $id)->first();
        if ($request->ajax()) {
            $data = Rekening::where('subkegiatan_id', $id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('kode_rekening', function ($data) {
                    $link = '<a href="' . route('detail.index', $data->id)  . '">' . $data->kode_rekening . '</a>';
                    return $link;
                })
                ->addColumn('nama_rekening', function ($data) {
                    $link = '<a href="' . route('detail.index', $data->id)  . '">' . $data->nama_rekening . '</a>';
                    return $link;
                })
                ->addColumn('pagu_rekening', function ($data) {
                    $link = 'Rp. ' . number_format($data->crossJoin('detail')->where('rekening_id', $data->id)->sum('jumlah'), 0, ',', '.');
                    return $link;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-xs editRekening"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs deleteRekening"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['kode_rekening', 'nama_rekening', 'pagu_rekening', 'action'])
                ->make(true);
        }
        return view('admin.rekening.data', compact('menu', 'id', 'subkegiatan', 'rekening'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'subkegiatan_id' => 'required|numeric',
            'kode_rekening' => 'required',
            'nama_rekening' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        Rekening::updateOrCreate(
            [
                'id' => $request->rekening_id
            ],
            [
                'kode_rekening' => $request->kode_rekening,
                'nama_rekening' => $request->nama_rekening,
                'subkegiatan_id' => $request->subkegiatan_id,
            ]
        );

        return response()->json(['success' => 'Detail saved successfully.']);
    }

    public function edit($subkeg_id, $id)
    {
        $rekening = Rekening::find($id);
        return response()->json($rekening);
    }

    public function destroy($id)
    {
        Rekening::find($id)->delete();
        return response()->json(['success' => 'Detail deleted successfully.']);
    }
}
