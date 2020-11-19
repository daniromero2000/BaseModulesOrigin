<?php

namespace Modules\Libranza\Http\Controllers\Front\benefitController;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function index()
    {
        return view('libranza.benefits.index');
    }
}
