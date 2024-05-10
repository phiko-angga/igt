<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $title = "Dashboard";
        $breadcrumb = ['Dashboard'];
        return view('welcome',compact('title','breadcrumb'));
    }
}
