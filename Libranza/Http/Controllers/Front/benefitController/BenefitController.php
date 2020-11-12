<?php

namespace Modules\Libranza\Http\Controllers\Front\benefitController;

use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function index()
    {
        return view('libranza.benefits::index');
    }
}
