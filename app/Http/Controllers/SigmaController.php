<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SigmaController extends Controller
{
    public function index(){
        return view('pages.back.calculator.sigma');
    }
}
