<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UploadController extends Controller
{
    public function upload()
    {
        return view('upload');
    }

    public function proses_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
            'keterangan' => 'required',
        ], [
            'file.required' => 'File gambar wajib diunggah.',
            'file.mimes' => 'Format file harus jpg, jpeg, png, atau gif.',
            'file.max' => 'Ukuran file maksimal 2MB.',
            'keterangan.required' => 'Keterangan wajib diisi.'
        ]);

        // Menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        // Informasi file
        echo 'File Name: ' . $file->getClientOriginalName() . '<br>';
        echo 'File Extension: ' . $file->getClientOriginalExtension() . '<br>';
        echo 'File Real Path: ' . $file->getRealPath() . '<br>';
        echo 'File Size: ' . $file->getSize() . '<br>';
        echo 'File Mime Type: ' . $file->getMimeType();

        // Folder tujuan
        $tujuan_upload = public_path('data_file');
        if (!File::isDirectory($tujuan_upload)) {
            File::makeDirectory($tujuan_upload, 0777, true);
        }

        // Upload file
        $file->move($tujuan_upload, $file->getClientOriginalName());

        return back()->with('success', 'File berhasil diupload!');
    }

    
    public function resize_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'keterangan' => 'required',
        ]);

        // Membuat instance ImageManager dengan driver GD
        $imageManager = new ImageManager(new Driver()); // Jika mau Imagick, ganti Driver() jadi Imagick\Driver()

        // Tentukan path lokasi upload
        $path = public_path('img/logo');

        // Jika folder belum ada, buat folder
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Ambil file dari form
        $file = $request->file('file');

        // Buat nama file unik
        $fileName = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Baca gambar dan resize
        $image = $imageManager->read($file->getRealPath());
        $resizedImage = $image->cover(200, 200);

        // Simpan gambar hasil resize
        file_put_contents($path . '/' . $fileName, $resizedImage->toJpeg());

        return redirect()->route('upload')->with('success', 'Data berhasil ditambahkan!');
    }

    public function dropzone()
    {
        return view('dropzone');
    }

    public function dropzone_store(Request $request)
    {
        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();

        $path = public_path('img/dropzone');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }

        $image->move($path, $imageName);
        return response()->json(['success' => $imageName]);
    }

    public function pdf_upload()
    {
        return view('pdf_upload');
    }

    public function pdf_store(Request $request)
    {
        $pdf = $request->file('file');
        $pdfName = 'pdf_' . time() . '.' . $pdf->extension();

        $path = public_path('pdf/dropzone');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }

        $pdf->move($path, $pdfName);
        return response()->json(['success' => $pdfName]);
    }
}