<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserHandlingController extends Controller
{
    public function index(){
        return view('userHandling');
    }
}
