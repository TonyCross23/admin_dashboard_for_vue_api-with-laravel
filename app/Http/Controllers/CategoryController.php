<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //category list
    public function category (){
        $category = Category::get();
        return view ('admin.category.index',compact('category'));
    }

    // category create
    public function categoryCreate (Request $request){
        $categoryData = $this->getCategoryData($request);
        $validator = $this->categoryValidationCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        Category::create($categoryData);
        return back();
    }

    // category delete
    public function categoryDelete($id){
        Category::where('category_id',$id)->delete();
        return redirect()->route('admin#category')->with(["DeleteSuccess" => 'Success Delete Category!']);
    }

    // category search
    public function categorySearch (Request $request){
        $category = Category::where('title','LIKE','%'.$request->categorySearch.'%')->get();
        return view ('admin.category.index',compact('category'));
    }

    // admin category edit page
    public function editPage($id){
        $category = Category::get();
        $updateCategory = Category::where('category_id',$id)->first();
        return view ('admin.category.edit',compact('category','updateCategory'));
    }

    // admin category update
    public function updateCategory ($id,Request $request){
        $updateData = $this->updateCategoryData($request);

        $validator = $this->categoryValidationCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        Category::where('category_id',$id)->update($updateData);
        return redirect()->route('admin#category');
    }

    //update category data
    private function updateCategoryData($request){
        return [
            "title" => $request->categoryName,
            "description" => $request->categoryDescription,
        ];
    }

    // get category data
    private function getCategoryData ($request){
        return [
            "title" => $request->categoryName,
            "description" => $request->categoryDescription,
        ];
    }

    //category validation
    private function categoryValidationCheck ($request){
        return Validator::make($request->all(), [
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ]);

    }
}
