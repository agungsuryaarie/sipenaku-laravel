<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Bagian;
use DataTables;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $menu = 'User';
        $bagian = Bagian::latest()->get();
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('bagian', function ($data) {
                    return $data->bagian->nama_bagian;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-xs editUser"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs deleteUser"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['bagian', 'nip', 'nama', 'username', 'foto', 'action'])
                ->make(true);
        }
        return view('admin.user.data', compact('menu', 'bagian'));
    }

    public function store(Request $request)
    {
        //Translate Bahasa Indonesia
        $message = array(
            'bagian_id.required' => 'Instansi harus dipilih.',
            'bagian_id.unique' => 'Instansi sudah terdaftar.',
            'nip.required' => 'NIP harus diisi.',
            'nip.numeric' => 'NIP harus angka.',
            'nip.min' => 'NIP minimal 18 angka.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama.required' => 'Nama harus diisi.',
            'nohp.required' => 'Nomor Handphone harus diisi.',
            'nohp.numeric' => 'Nomor Handphone harus angka.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Penulisan email tidak benar.',
            'email.unique' => 'Email sudah terdaftar.',
            'username.required' => 'Username harus diisi.',
            'username.min' => 'Username minimal 8.',
            'username.unique' => 'Username sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8.',
            'repassword.required' => 'Harap konfirmasi password.',
            'repassword.same' => 'Password harus sama.',
            'repassword.min' => 'Password minimal 8.',
            'level.required' => 'Level harus dipilih.',
        );
        //Check If Field Unique
        if (!$request->user_id) {
            //rule tambah data tanpa user_id
            $ruleIns = 'required|unique:users,bagian_id';
            $ruleNip = 'required|min:18|numeric|unique:users,nip';
            $ruleEmail = 'required|email|unique:users,email';
            $ruleUsername = 'required|unique:users,username|min:8';
        } else {
            //rule edit jika tidak ada user_id
            $lastIns = User::where('id', $request->user_id)->first();
            if ($lastIns->bagian_id == $request->bagian_id) {
                $ruleIns = 'required';
            } else {
                $ruleIns = 'required|unique:users,bagian_id';
            }
            $lastNip = User::where('id', $request->user_id)->first();
            if ($lastNip->nip == $request->nip) {
                $ruleNip = 'required|min:18|numeric';
            } else {
                $ruleNip = 'required|min:18|numeric|unique:users,nip';
            }
            $lastEmail = User::where('id', $request->user_id)->first();
            if ($lastEmail->email == $request->email) {
                $ruleEmail = 'required|email';
            } else {
                $ruleEmail = 'required|email|unique:users,email';
            }
            $lastUsername = User::where('id', $request->user_id)->first();
            if ($lastUsername->username == $request->username) {
                $ruleUsername = 'required|min:8';
            } else {
                $ruleUsername = 'required|unique:users,username|min:8';
            }
        }
        $validator = Validator::make($request->all(), [
            'bagian_id' => $ruleIns,
            'nip' => $ruleNip,
            'nama' => 'required|max:255',
            'nohp' => 'required|numeric',
            'email' => $ruleEmail,
            'username' => $ruleUsername,
            'password' => 'required|min:8',
            'repassword' => 'required|same:password|min:8',
            'level' => 'required',
        ], $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        User::updateOrCreate(
            [
                'id' => $request->user_id
            ],
            [
                'bagian_id' => $request->bagian_id,
                'nip' => $request->nip,
                'nama' => $request->nama,
                'nohp' => $request->nohp,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'level' => $request->level,
                'status' => 1,
            ]
        );

        return response()->json(['success' => 'User saved successfully.']);
    }
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }


    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['success' => 'User deleted successfully.']);
    }
}