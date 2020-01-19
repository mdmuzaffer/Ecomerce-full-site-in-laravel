<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use DB;
use App\cmsPage;
use App\Category;
class cmspageController extends Controller
{
	//cms page load
	public function cmsPage(){
		return view('admin.page.cmspage');
	}
	//cms page date
    public function addcmsPage(Request $request){
		$pageData = $request->all();
		/* echo"<pre>";
		print_r($pageData);
		die; */ 
		$cmspage = new cmsPage;
		$cmspage->title = $pageData['page_title'];
		$cmspage->description = $pageData['page_description'];
		$cmspage->meta_title = $pageData['meta_title'];
		$cmspage->meta_keywords = $pageData['meta_keywords'];
		$cmspage->meta_description = $pageData['meta_description'];
		$cmspage->url = $pageData['page_url'];
		if(empty($pageData['enable'])){
			$status =0;
		}else{
			$status =1;
		}
		$cmspage->status = $status;
		$cmspage->save();
		return redirect()->back()->with('flush_message_success','Your page save Successfully');
	}
	
	// view cmas page
	public function viewcmsPage(){
		$cmspageData = DB::table('cms_pages')->get();
		$cmspageData = json_decode(json_encode($cmspageData));
		return view('admin.page.view_cmspage')->with(['cmspageData'=>$cmspageData,'page_type'=>'admin_inner']);
	}
	//update cms page form
	public function editPage($id){
		$cmspageEdit = cmsPage::where('id',$id)->first();
		$cmspageEdit = json_decode(json_encode($cmspageEdit));
		/* echo"<pre>";
		print_r($cmspageEdit);
		die; */
		return view('admin.page.update_cmspage')->with(['cmspageEdit'=>$cmspageEdit,'page_type'=>'admin_inner']);

	}
	//udate cms data into table
	public function updatePage(Request $request, $id){
		$updatepagedata = $request->all();
		if(empty($updatepagedata['enable'])){
			$status =0;
		}else{
			$status =1;
		}		
		DB::table('cms_pages')->where('id', $id)->update([
		'title'=> $updatepagedata['page_title'],
		'description'=> $updatepagedata['page_description'],
		'url'=> $updatepagedata['page_url'],
		'meta_title'=> $updatepagedata['meta_title'],
		'meta_keywords'=> $updatepagedata['meta_keywords'],
		'meta_description'=> $updatepagedata['meta_description'],
		'status'=> $status
			]);
		return redirect()->back()->with('flush_message_success','Your page Successfully updated');
	}
	
	//delete cms page
	public function deletePage($id){
		//echo $id;
		DB::table('cms_pages')->where('id', $id)->delete();
		return redirect()->back()->with('flush_message_success','Your page Successfully delete');

	}
	
	// frontend footer page data with url
	public function pageUrl($url){
		$CmspageCount = DB::table('cms_pages')->where(['url'=>$url,'status'=>1])->Count();
		if($CmspageCount>0){
			$pageUrldata = DB::table('cms_pages')->where('url',$url)->first();
		}else{
			abort(404);
		}
		//SEO data from table
		$meta_title = $pageUrldata->meta_title;
		$meta_description = $pageUrldata->meta_keywords;
		$meta_keywords = $pageUrldata->meta_description;
		
		//siderbar category menu 
		$maincategory = Category::with('categories')->where(['parent_id'=>0])->get();
		$pageUrldata = json_decode(json_encode($pageUrldata ));
		return view('page.cmsPages')->with(['pageUrldata'=>$pageUrldata,'maincategory'=>$maincategory,'meta_title'=>$meta_title,'meta_description'=>$meta_description,'meta_keywords'=>$meta_keywords]);
	}

	// contact us page form
	public function contactUs(Request $request){
		$contactData = $request->all();
		if($request->isMethod('post')){
			echo"<pre>";
			print_r($contactData);
			$email = "developerphp1995@gmail.com";
			$messageData =[
			'name'=> $contactData['name'],
			'email'=> $contactData['email'],
			'subject'=> $contactData['subject'],
			'comment'=> $contactData['message']
			];
			Mail::send('mail.contact',$messageData,function($message)use($email){
				$message->to($email)->subject('Contact form Muzaffer E-com website');
			});
			return redirect()->back()->with('flush_message_success','Thanks for your enquery.We will get back to you soon !');
		}
		$maincategory = Category::with('categories')->where(['parent_id'=>0])->get();
		//SEO for contact us page
		$meta_title ="E-shop contact website";
		$meta_description ="if any query contact us ,for shop";
		$meta_keywords ="enquery website,online help,men cloth products info";
		
		return view('page.contact')->with(['maincategory'=>$maincategory,'meta_title'=>$meta_title,'meta_description'=>$meta_description,'meta_keywords'=>$meta_keywords]);

	}
}
