<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index(){
        $students = [
            [
                'nama' => "Andi Riswanda",
                'nim' => "H071231008",
                'prodi' => 'Sistem Informasi'
            ],
            [
                'nama' => "Wandi",
                'nim' => "H071231007",
                'prodi' => 'Statistika'
            ]
        ];

        return view('base')->with('students',$students);
        // return view('base',compact('students'));
    }
}
