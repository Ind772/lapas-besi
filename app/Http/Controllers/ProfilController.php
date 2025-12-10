<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display profil page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('profil');
    }
}