<?php

namespace Modules\Libranza\Http\Controllers\Front\aboutController;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('about::index');
    }        
}
