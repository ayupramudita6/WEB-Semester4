<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        //validasi data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        //simpan data
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}