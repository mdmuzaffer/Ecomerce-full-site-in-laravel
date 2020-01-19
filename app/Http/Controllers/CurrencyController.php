<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use DB;
class CurrencyController extends Controller
{
    //add currency form
	public function addCurrency(Request $request){
		if($request->isMethod('post')){
			$currencyData = $request->all();
			
			if(empty($currencyData['enable'])){
				$enable ="0";
			}else{
				$enable = $currencyData['enable'];
			}
			
			$currency = new Currency;
			$currency->currency_code = $currencyData['currency_code'];
			$currency->exchange_rate = $currencyData['exchange_rate'];
			$currency->status = $enable;
			$currency->save();
			return redirect()->back()->with('flush_message_success','Currency save successfully');
		}
		return view('admin.currency.add_currency');
	}
	
	public function viewCurrency(){
		$CorrencyView = DB::table('currencies')->get();
		return view('admin.currency.view_currency')->with(compact('CorrencyView'));
	}
	
	public function updateCurrency(Request $request, $id){
		$currData = DB::table('currencies')->where('id',$id)->first();
		return view('admin.currency.update_currency')->with(compact('currData'));
	}
	public function currencyUpdate(Request $request){
			if($request->isMethod('post')){
			$updata = $request->all();
			if(empty($updata['enable'])){
				$enable =0;
			}else{
				$enable =1;
			}
			DB::table('currencies')->where('id',$updata['currency_id'])->update([
			'currency_code' => $updata['currency_code'],
			'exchange_rate' => $updata['exchange_rate'],
			'status' => $enable
			]);
			return redirect()->back()->with('flush_message_success','Currency updated successfull');
		
		}
	}
	// delete currency
	public function DeleteCurrency($id){
		DB::table('currencies')->where(['id'=>$id])->delete();
		return redirect()->back()->with('flush_message_success','Currency delete successfull !');

	}
}
