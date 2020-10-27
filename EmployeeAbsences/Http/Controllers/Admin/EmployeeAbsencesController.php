<?php

namespace Modules\EmployeeAbsences\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Entities\Generals\Cities\City;

class EmployeeAbsencesController extends Controller
{


public function __construct()
{
     $this->middleware(['permission:absences, guard:employee']);
} 






    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
     
        return view('employeeabsences::admin.Absences.list');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $employee_user= auth()->guard('employee')->user()->department;
         $cities=city::all();
        return view('employeeabsences::admin.Absences.create',\compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // $request->employee_user =   $employee_user= auth()->guard('employee')->user();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('employeeabsences::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('employeeabsences::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
