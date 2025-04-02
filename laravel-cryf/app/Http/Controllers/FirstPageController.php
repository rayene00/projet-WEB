<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirstPageController extends Controller
{
    public function index()
    {
        return view('firstpage');
    }
}
