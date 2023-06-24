<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaftarHadirController extends Controller
{
    public function getView() 
    {
        return view('pages.DaftarHadir');
    }
}
