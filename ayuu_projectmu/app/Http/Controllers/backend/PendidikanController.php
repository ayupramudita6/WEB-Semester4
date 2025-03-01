<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Fcades\DB;
    App\Http\Controllers\Controller;

class PendidikanController extends Controller
{
    public function index()
{
    return view('backend.pengalaman_kerja.index');
}
public function create()
{
    $pengalaman_kerja = null;
    return view('backend.pengalaman_kerja.create',compact('pengalaman_kerja'));
}
public function store(Request $request)
{
    DB::table('pengalaman_kerja')->insert([
        'nama' => $request->nama,
        'jabatan' => $request->jabatan,
        'tahun_masuk' => $request->tahun_masuk,
        'tahun_keluar' => $request->tahun_keluar
    ]);

    return redirect()->route('pengalaman_kerja.index')
                    ->with('success','Data pengalaman_kerja baru telah berhasil disimpan.');
}
}
