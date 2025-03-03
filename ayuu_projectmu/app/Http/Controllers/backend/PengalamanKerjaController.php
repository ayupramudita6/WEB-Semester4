<?php
namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PengalamanKerjaController extends Controller
{
    public function index()
    {
        // Ambil semua data pengalaman kerja dari database
        $pengalaman_kerja = DB::table('pengalaman_kerja')->get();

        // Kirim data ke view
        return view('backend.pengalaman_kerja.index', compact('pengalaman_kerja'));
    }

    public function create()
    {
        return view('backend.pengalaman_kerja.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tahun_masuk' => 'required|integer',
            'tahun_keluar' => 'required|integer',
        ]);

        // Simpan data ke dalam database
        DB::table('pengalaman_kerja')->insert([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_keluar' => $request->tahun_keluar
        ]);

        return redirect()->route('pengalaman_kerja.index')
            ->with('success', 'Data pengalaman kerja baru telah berhasil disimpan.');
    }

    public function edit($id)
    {
        // Ambil data berdasarkan ID
        $pengalaman_kerja = DB::table('pengalaman_kerja')->where('id', $id)->first();

        // Cek jika data tidak ditemukan
        if (!$pengalaman_kerja) {
            return redirect()->route('pengalaman_kerja.index')->with('error', 'Data tidak ditemukan.');
        }

        return view('backend.pengalaman_kerja.edit', compact('pengalaman_kerja'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tahun_masuk' => 'required|integer',
            'tahun_keluar' => 'required|integer',
        ]);

        // Update data dalam database
        DB::table('pengalaman_kerja')->where('id', $id)->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_keluar' => $request->tahun_keluar
        ]);

        return redirect()->route('pengalaman_kerja.index')
            ->with('success', 'Data pengalaman kerja berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Hapus data dari database
        DB::table('pengalaman_kerja')->where('id', $id)->delete();

        return redirect()->route('pengalaman_kerja.index')
            ->with('success', 'Data pengalaman kerja berhasil dihapus.');
    }
}