<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return "Ini adalah halaman User";
    }

    public function show()
    {
        return "Ini adalah halaman profil user6.";
    }
}
