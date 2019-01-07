<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public static function getAllPost(){
		$posts = Post::orderBy('created_at', 'desc')->get();
		return $posts;    	
    }
}
