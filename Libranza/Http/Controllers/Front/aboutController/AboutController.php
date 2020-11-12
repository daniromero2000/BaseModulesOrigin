<?php

namespace Modules\Libranza\Http\Controllers\Front\aboutController;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('libranza.about.index');
    }        
}
