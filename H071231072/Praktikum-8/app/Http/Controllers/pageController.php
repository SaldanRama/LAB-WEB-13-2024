<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function gallery() 
    {
        return view('Gallery');
    }

    public function contact()
    {
        return view('contact');
    }
}