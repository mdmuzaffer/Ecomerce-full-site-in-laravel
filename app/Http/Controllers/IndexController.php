<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Category;
use DB;
use App\Banner;

class IndexController extends Controller
{
	public function index(){
		//assending order products
		//$Allproduct = Products::get();
		
		//Decending order products with limite
		//$Allproduct = Products::orderBy('id','DESC')->take(6)->get();
		$Allproduct = Products::inRandomOrder()->orderBy('id','DESC')->take(-1)->where('status',1)->where('feature_item',1)->paginate(6);
		//Rendom order products 
		//$Allproduct = Products::inRandomOrder()->get();
		
		//feach products with parent category
		//$maincategory = Category::where(['parent_id'=>0])->get();
		// banner slider data fetch
		$banner = Banner::where('status','1')->get();
		$maincategory = Category::with('categories')->where(['parent_id'=>0])->get();
		
		// for SEO using 
		$meta_title ="E-shop sample website";
		$meta_description ="Online shopping website for Men,Women,and Kid Cloth";
		$meta_keywords ="eshop website,online website,men cloth";
		return view('index')->with(['maincategory'=>$maincategory,'Allproduct'=>$Allproduct,'banner'=>$banner,'controller'=>'index','page_type'=>'front','meta_title'=>$meta_title,'meta_description'=>$meta_description,'meta_keywords'=>$meta_keywords]);
	}

}
