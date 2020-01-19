<?php

namespace App\Exports;

use App\NewsLetter;
use Maatwebsite\Excel\Concerns\FromCollection;

class subscribersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       // return NewsLetter::all();
		$newsEmail = NewsLetter::select('id','email','status','created_at')->where('status',1)->orderBy('id', 'DESC')->get();
		return $newsEmail;
    }
}
