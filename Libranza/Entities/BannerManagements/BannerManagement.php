<?php

namespace Modules\Libranza\Entities\BannerManagements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerManagement extends Model
{
    use SoftDeletes;
    protected $table = 'banner_managements';

    protected $fillable = [
        'id',
        'name',
        'alt',
        'is_active',
        'sort_order',
        'src'
       ];
   
       protected $hidden = [
           'update_at',
           'deleted_at',
           'status'
       ];
   
       protected $guarded = [
           'created_at',
           'updated_at',
           'deleted_at'
       ];
   
       protected $dates = [
           'created_at',
           'updated_at',
           'deleted_at'
       ];
          
}
