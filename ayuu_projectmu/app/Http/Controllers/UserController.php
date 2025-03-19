<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return "Halaman User";
    }

    public function showProfile() {
        $url = route('profile', ['id' => 1]);
        
        return redirect()->route('profile', ['id' => 1]);
    }
}