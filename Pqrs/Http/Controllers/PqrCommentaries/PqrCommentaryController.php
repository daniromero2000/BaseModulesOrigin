<?php

namespace Modules\Pqrs\Http\Controllers\PqrCommentaries;

use Modules\Pqrs\Entities\PqrCommentaries\Repositories\Interfaces\PqrCommentaryRepositoryInterface;
use Modules\Pqrs\Entities\PqrCommentaries\Requests\CreatePqrCommentaryRequest;
use App\Http\Controllers\Controller;

class PqrCommentaryController extends Controller
{
    private $pqrcommentaryInterface;

    public function __construct(
        PqrCommentaryRepositoryInterface $pqrcommentaryRepositoryInterface
    ) {
        $this->pqrcommentaryInterface = $pqrcommentaryRepositoryInterface;
        $this->middleware(['permission:pqrs, guard:employee']);
    }


    public function store(CreatePqrCommentaryRequest $request)
    {
        $this->pqrcommentaryInterface->createPqrCommentary($request->except('_token', '_method'));

        $request->session()->flash('message', 'Creación Exitosa');
        return back()->with('message', 'Comentario guardado.');
    }
}
