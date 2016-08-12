<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id','is_approved','author_id','content'];

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function replies(){
        return $this->hasMany('App\Reply');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
