<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\actionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActionLogController extends Controller
{
    //acttion log
    public function TrendPost (){
        
        $post = actionLog::select('action_logs.*','posts.*',DB::raw('COUNT(action_logs.post_id) as post_count'))
                                    ->leftJoin('posts','posts.post_id','action_logs.post_id')
                                    ->groupBy('action_logs.post_id')
                                    ->get();
        return view ('admin.trendPost.index',compact('post'));
    }

    // action log details post
    public function TrendsPostDetails ($id){

        $post = Post::where('post_id',$id)->first();
        return view('admin.trendPost.details',compact('post'));
    }
}
