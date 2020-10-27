<?php

namespace Modules\EmployeeAbsences\Entities\Absences\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAbsenceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'commentary' => ['required', 'bail', 'max:255'],
            'constancy' => ['required', 'max:255', 'bail'],
            'start_date' => ['required'],
            'finish_date' => ['required'],
            'state' => ['required'],
            'employee_id' => ['required', 'bail'],
            'boss_id' => ['required', 'bail'],
            'reason_id' => ['required', 'bail'],
        ];
    }
}
