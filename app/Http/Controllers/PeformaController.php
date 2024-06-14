<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeformaController extends Controller
{
    public function index()
    {
        return view('admin.peforma');
    }
}
