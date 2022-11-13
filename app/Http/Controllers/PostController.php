<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct post page
    public function postPage (){
        $category = Category::get();
        $post = Post::get();
        return view ('admin.post.index',compact('post','category'));
    }

    // post create page
    public function createPage (Request $request){
        $validator = $this-> postValidationCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if(!empty($request->postImage)){
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);
            $data = $this->getPostData ($request,$fileName);
        }else{
            $data = $this->getPostData ($request,NULL);
        }
        Post::create($data);
        return back();
    }

    // post delete
    public function postDelete ($id){
        $postData = Post::where('post_id',$id)->first();
        $dbImage = $postData['image'];
        Post::where('post_id',$id)->delete();

        if(File::exists(public_path().'/postImage/'.$dbImage)){
            File::delete(public_path().'/postImage/'.$dbImage);
        }
        return back();
    }

    // post edit page
    public function editPost ($id){
        $category = Category::get();
        $post = Post::get();
        $postData = Post::where('post_id',$id)->first();
        return view ('admin.post.edit',compact('category','post','postData'));
    }

    // post update
    public function updatePost ($id,Request $request){
        $validator = $this-> postValidationCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = $this->getUpdateData($request);

        if(isset($request->postImage)){
            $this->getImageUpdate($id,$request,$data);
        }else{
            Post::where('post_id',$id)->update($data);
        }

        return back();
    }


    // get image update
    private function getImageUpdate ($id,$request,$data){
        $file = $request->file('postImage');
        $fileName = uniqid().'_'.$file->getClientOriginalName();
        $data['image'] = $fileName;

        $postData = Post::where('post_id',$id)->first();
        $dbImage = $postData['image'];

        if(File::exists(public_path().'/postImage/'.$dbImage)){
            File::delete(public_path().'/postImage/'.$dbImage);
        }
        $file->move(public_path().'/postImage',$fileName);

        Post::where('post_id',$id)->update($data);
    }

    // get update data
    private function getUpdateData($request){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
            'updated_at' => Carbon::now(),
        ];
    }

    // get post data
    private function getPostData ($request,$fileName){
        return [
            "title" => $request->postTitle,
            "description" => $request->postDescription,
            "category_id" => $request->postCategory,
            "image" => $fileName,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ];
    }

    // post validation check
    private function postValidationCheck ($request){
        return Validator::make($request->all(), [
            "postTitle" => 'required',
            "postDescription" => 'required',
            "postImage" => 'mimes:png,jpg,Web,jfif ',
            "postCategory" => 'required'
        ]);

    }
}
