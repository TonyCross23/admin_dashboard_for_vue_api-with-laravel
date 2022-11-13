<?php

namespace App\Http\Controllers\api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;

class PostController extends Controller
{
    //get all post list
    public function allPostList (){
        $post = Post::get();

        return response()->json([
            "post" => $post
        ]);
    }

    // all post search
    public function allPostSearch (Request $request){

        $Post = Post::where('title','LIKE','%'.$request->key.'%')->get();
        return response()->json([
            "searchData" => $Post
        ]);
    }

    // post details
    public function postDetails (Request $request){
        $id = $request->postId;
        $postData = Post::where('post_id',$id)->first();

        return response()->json([
            'post' => $postData
        ]);
    }
}
