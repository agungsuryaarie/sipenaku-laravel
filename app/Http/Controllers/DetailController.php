<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use App\Models\Detail;
use Illuminate\Http\Request;
use DataTables;

class DetailController extends Controller
{
    public function index(Request $request, $id)
    {
        $menu = 'Detail';
        $id = $id;
        $rekening = Rekening::where('id', $id)->first();
        if ($request->ajax()) {
            $data = Detail::with('rekening')->where('id_rekening', $id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-xs editDetail"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs deleteDetail"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.detail.data', compact('menu', 'id', 'rekening'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'nama_detail' => 'required',
            // 'koefisien' => 'required',
            // 'satuan' => 'required',
            // 'harga' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        Detail::updateOrCreate(
            [
                'id' => $request->detail_id
            ],
            [
                'id_rekening' => $request->id_rekening,
                'nama_detail' => $request->nama_detail,
                'koefisien' => $request->koefisien,
                'satuan' => $request->satuan,
                'harga' => $request->harga,
                'jumlah' => $request->jumlah,

            ]
        );

        return response()->json(['success' => 'Detail saved successfully.']);
    }

    public function edit($id)
    {
        $detail = Detail::find($id);
        return response()->json($detail);
    }

    public function destroy($id)
    {
        Detail::find($id)->delete();
        return response()->json(['success' => 'Detail deleted successfully.']);
    }
}
