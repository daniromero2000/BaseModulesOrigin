<?php

namespace Modules\CamStudio\Entities\CammodelImages;

use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Illuminate\Database\Eloquent\Model;

class CammodelImage extends Model
{
    protected $table = 'cammodel_images';

    protected $fillable = [
        'cammodel_id',
        'src'
    ];

    protected $hidden = [
        'id',
    ];

    protected $guarded = [
        'id',
    ];

    protected $dates  = [];

    public $timestamps = false;

    public function cammodel()
    {
        return $this->belongsTo(Cammodel::class);
    }
}