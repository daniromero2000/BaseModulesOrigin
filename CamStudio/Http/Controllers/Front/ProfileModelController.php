<?php

namespace Modules\CamStudio\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class ProfileModelController extends Controller
{
    public function index()
    {
        return view('camstudio::front.profile-model');
    }
}
