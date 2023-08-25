<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutMeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'About Me',
        ];
        return view('about-me', $data);
    }
}
