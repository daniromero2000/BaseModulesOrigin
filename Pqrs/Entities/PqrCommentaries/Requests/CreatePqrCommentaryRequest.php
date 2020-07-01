<?php

namespace Modules\Pqrs\Entities\PqrCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePqrCommentaryRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'pqr_id'     => ['required', 'bail'],
            'commentary' => ['required', 'max: 255', 'bail'],
            'user'       => ['required', 'max: 255']
        ];
    }
}
