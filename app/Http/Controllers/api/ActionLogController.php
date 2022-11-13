<?php

namespace App\Http\Controllers\api;

use App\Models\actionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionLogController extends Controller
{
    //action log count
    public function postActionLog (Request $request){
        $data = [
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
        ];

        actionLog::create($data);

        $postData = actionLog::where('post_id',$request->post_id)->get();

        return response()->json([
            'post' => $postData
        ]);
    }
}
