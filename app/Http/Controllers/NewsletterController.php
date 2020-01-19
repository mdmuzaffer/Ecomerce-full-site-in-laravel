<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\NewsLetter;
use App\Exports\subscribersExport;
class NewsletterController extends Controller
{
    //subscribe Newsletter function_exists
	public function subscribeNewsletter(Request $request){
		if($request->ajax()){
			$newsletter = $request->all();
			$emailCount = NewsLetter::where('email',$newsletter['email'])->count();
			if($emailCount >0){
			return response()->json(['success' =>2, 'message'=>'You Have Already Subscribed !'],200);
			}else{
				$news= new NewsLetter;
				$news->email = $newsletter['email'];
				$news->save();
				return response()->json(['success' =>1, 'message'=>'You Newsletter Subscribe Successfully !'],200);
			}
		}
		
	}
	// news letter view
	public function newsLetter(){
		$newsData = NewsLetter::get();
		return view('admin.newsletter.newsletter_view')->with(compact('newsData'));
	}
	// news letter status 
	public function newsLetterStatus($id, $status){
		NewsLetter::where('id',$id)->update(['status'=>$status]);
		return redirect()->back()->with('flush_message_success','News Letter status has been updated !');
	}
	
	public function newsLetterDelete($id){
		NewsLetter::where('id',$id)->delete();
		return redirect()->back()->with('flush_message_success','New letter deleted successfully !');
	}
	
/* 	public function newsletterExport(){
		$newsEmail = NewsLetter::select('id','email','status','created_at')->where('status',1)->orderBy('id', 'DESC')->get();
		$newsEmail = json_decode(json_encode($newsEmail),true);
		// download in excel formate code 
		return Excel::create('subscribe'.rand(),function($excel) use($newsEmail){
			$excel->sheet('mySheet',function($sheet) use($newsEmail){
				$sheet->fromArray($newsEmail);
			});
		})->download('xlsx');
		
	} */
	
	
	public function newsletterExport(){
		return Excel::download(new subscribersExport, 'subscribe.xlsx');
	}
}
