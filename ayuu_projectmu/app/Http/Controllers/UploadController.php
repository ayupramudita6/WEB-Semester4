<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_file';
    
        // upload file
        $file->move($tujuan_upload, $file->getClientOriginalName());
    }    
}