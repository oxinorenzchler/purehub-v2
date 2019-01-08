<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
	//Add post
    public function store(StorePostRequest $request){

    	$post = new Post;
    	$post->user_id = 1;
    	$post->content = $request->content;

    	//Image
    	if($request->hasFile('file')){
    		//get image
    		$image = $request->file('file');
    		$image_name = time().'.'.$image->getClientOriginalExtension();
    		//path
    		$path = "images/users/1/";
    		//upload
    		$image->move($path, $image_name);
    		//store DB
    		$post->image = $path.$image_name;
    	}

    	$post->save();

    	return response()->json([
    		'post_id' => $post->id,
    		'content' => $post->content,
    		'image' => $post->image,
    		'user' => $post->user->name,
    		'created_at' => $post->created_at->diffForHumans(), 
    	]);

    }

    //Edit Post
    public function update(StorePostRequest $request){
    	$id = $request->postid;
    	$content = $request->content;
		
		$post = Post::find($id);
		$post->content = $content;

		if($request->hasFile('file')){
			$image = $request->file('file');
			$image_name = time().'.'.$image->getClientOriginalExtension();
			$path = "images/users/".Auth::user()->id.'/';
			$image->move($path, $image_name);

			$post->image = $path.$image_name;
		}
		$post->save();

		return response()->json($post);    	
    }

    //Delete Post
    public function delete(Request $request){
    	$post = Post::find($request->id);
    	$post->delete();

    	return response('ok',200)->header('Content-Type','text/plain');
    }
}
