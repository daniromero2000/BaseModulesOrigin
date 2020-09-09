<?php

namespace Modules\CamStudio\Entities\CammodelImages;

use Modules\CamStudio\Entities\Cammodels\Cammodel;

class CammodelImageRepository
{
    protected $model;
    private $columns = [];

    public function __construct(CammodelImage $cammodelImage)
    {
        $this->model = $cammodelImage;
    }

    public function findCammodel(): Cammodel
    {
        return $this->model->cammodel;
    }
}