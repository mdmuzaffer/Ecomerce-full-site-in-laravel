<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use Hash;
use App\Category;
class CategoryController extends Controller
{
    public function category(){
		if(!Session::has('adminSession')){
			return redirect('/admin')->with('flush_message_error','First Login to access setting page!');
		}else{
			$levels = Category::where(['parent_id'=>0])->get();
			return view('admin.category.add_category')->with(array('levels'=>$levels,'controller'=>'category','page_type'=>'category'));
		}
		
	}
	public function addCategory(Request $request){
		
		if($request->isMethod('post')){
			$data = $request->all();
			//print_r($data);
			$status ="";
			if(empty($data['enable'])){
				$status.=0;
			}else{
				$status.=1;
			}
			$category = new Category();
			$category->name = $data['category'];
			$category->parent_id = $data['category_name'];
			$category->url = $data['url'];
			$category->description = $data['description'];
			$category->status = $status;
			$category->save();
			return redirect('/admin/view-category')->with('flush_message_success','Added successfully new Category!');
		}
		
	}
	public function viewCategory(){
		$category = Category::get();
		$levels = Category::where(['parent_id'=>0])->get();
		return view('admin.category.view_category')->with(array('levels'=>$levels,'category'=>$category,'controller'=>'category','page_type'=>'category'));
	}
	
	public function updateCategory(Request $request){
		$data = $request->all();
		//$updteCategory = new Category();
		Category::where('id',$data['id'])->update(['name'=>$data['category'],'url'=>$data['url'],'status'=>$data['enable']['0'],'description'=>$data['updesc'],'parent_id'=>$data['catLevel']]);
        return response()->json(['success'=>1,"message"=>"update category successfully"],200);  
            
	}
	public function deleteCategory(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			Category::where('id',$data['id'])->delete();
			return response()->json(['success'=>1,"message"=>"Delete category successfully"],200);  
           }
	}
}
