<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Image;

class UploadController extends Controller
{
    public function upload(){
        return view('upload');
    }
    
    public function proses_upload(Request $request){
        $this->validate($request, [
            'file' => 'required',
            'keterangan' => 'required',
        ]);
    
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');
    
        // nama file
        echo 'File Name: '.$file->getClientOriginalName().'<br>';
        
        // ekstensi file
        echo 'File Extension: '.$file->getClientOriginalExtension().'<br>';
        
        // real path
        echo 'File Real Path: '.$file->getRealPath().'<br>';
        
        // ukuran file
        echo 'File Size: '.$file->getSize().'<br>';
        
        // tipe mime
        echo 'File Mime Type: '.$file->getMimeType().'<br>';
    
        // isi dengan nama folder tempat menyimpan file
        $tujuan_upload = public_path('data_file');
    
        // jika folder belum ada, buat folder
        if (!File::isDirectory($tujuan_upload)) {
            File::makeDirectory($tujuan_upload, 0777, true);
        }

        // upload file
        $file->move($tujuan_upload, $file->getClientOriginalName());
    }

    public function resize_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
            'keterangan' => 'required',
        ]);

        // Tentukan path lokasi upload
        $path = public_path('img/logo');

        // Jika folder belum ada, buat folder
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Mengambil file image dari form
        $file = $request->file('file');

        // Membuat nama file unik
        $fileName = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Membuat canvas image sebesar dimensi
        $canvas = Image::canvas(200, 200);

        // Resize image sesuai dimensi dengan mempertahankan rasio
        $resizeImage = Image::make($file)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });

        // Memasukkan image yang telah di-resize ke dalam canvas
        $canvas->insert($resizeImage, 'center');

        // Simpan image ke folder
        if ($canvas->save($path . '/' . $fileName)) {
            return redirect(route('upload'))->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect(route('upload'))->with('error', 'Data gagal ditambahkan!');
        }
    }
}
