<?php

namespace Modules\Libranza\Entities\Subscriptions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Blog\WinkPost;

class Subscription extends Model
{
    use SoftDeletes;
    protected $table = 'subscriptions';

    protected $fillable = [
        'id',
        'name',
        'last_name',
        'email',
        'telephone',
        'post_id'
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

    public function post()
    {
        return $this->belongsTo(WinkPost::class, 'post_id');
    }
          
}
