<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id','is_approved','user_id','content'];

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function replies(){
        return $this->hasMany('App\Reply');
    }

    public function author(){
        return $this->belongsTo('App\User');
    }
}
