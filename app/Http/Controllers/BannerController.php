<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use DB;
use Auth;
use Session;
use App\Banner;
class BannerController extends Controller
{
    //banner slider chage dynamic
	public function index(){
		$banner = Banner::all();
		return view('admin.banner.banner_add')->with(['banner'=>$banner,'controller'=>'banner']);
	}
	public function bannerSave(Request $request){
	if($request->isMethod('post')){
		
		$data_banner = $request->all();
		$Banner = new Banner;
		$Banner->title = $data_banner['title'];
		$Banner->link = $data_banner['link'];
		$Banner->content = $data_banner['content'];
		//$Banner->status = $data_banner['status'];
		// images for banner
		if($request->hasFile('image')){
			$image_temp = $request->file('image');
			if($image_temp->isValid()){
			$extension = $image_temp->getClientOriginalExtension();
			$image_name = $request->file('image')->getClientOriginalName();
			$filename = rand(111,99999).'_'.$image_name;
			$large_image_path = 'images/frontend_image/banner/'.$filename;
			
			Image::make($image_temp)->resize(1280,600)->save($large_image_path);
			$Banner->image =$filename;
			}
				
		}
		
		if(empty($data_banner['status'])){
				$enable = 0;
			}else{
				$enable = 1;
			}
			$Banner->status = $enable;
			$Banner->save();
			return redirect()->back()->with('flush_message_success','Banner data save Successfully');
	
	}
	
	}
	//banner slider update dynamically
	public function edit(){
		$banner = Banner::all();
		return view('admin.banner.banner_edit')->with(['banner'=>$banner,'controller'=>'banner']);
	}
	
	public function bannerUpdate($id){
		$bannerUpdate = Banner::where('id',$id)->first();
		return view('admin.banner.banner_update')->with(['bannerUpdate'=>$bannerUpdate,'controller'=>'banner']);
	}
	public function bannerChangeupdate(Request $request){
		$updateData = $request->all();
		// images for banner
		if($request->hasFile('image')){
			$image_temp = $request->file('image');
			if($image_temp->isValid()){
			$extension = $image_temp->getClientOriginalExtension();
			$image_name = $request->file('image')->getClientOriginalName();
			$filename = rand(111,99999).'_'.$image_name;
			$large_image_path = 'images/frontend_image/banner/'.$filename;
			
			Image::make($image_temp)->resize(1280,600)->save($large_image_path);
			$filenames =$filename;
			}
				
		}
		
		if(empty($updateData['status'])){
				$enable = 0;
			}else{
				$enable = 1;
			}
			$enables = $enable;
			
		DB::table('banners')->where('id', $updateData['id'])->update([
		'title'  => $updateData['title'],
		'link'  => $updateData['link'],
		'content' => $updateData['content'],
		'image'  => $filenames,
		'status' => $enables
			]);
		return redirect()->back()->with('flush_message_success','Product Update Successfully');
	}
	
	public function bannerDelete($id){
		Banner::where('id',$id)->delete();
		return redirect()->back()->with('flush_message_success','Product delete Successfully');

	}
}
