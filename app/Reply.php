<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['comment_id','is_approved','author_id','content'];

    public function comment(){
        return $this->belongsTo('App\Comment');
    }

    public function author(){
        return $this->belongsTo('App\User');
    }
}
