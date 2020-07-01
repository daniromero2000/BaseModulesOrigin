<?php

namespace App\Http\Controllers\Front;

class HomeController
{
    public function index()
    {
        return view('front.index', []);
    }
}
