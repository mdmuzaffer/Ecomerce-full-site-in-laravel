<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class usersExport implements WithHeadings,FromCollection,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
		$users = User::where('status',1)->orderBy('id','DESC')->get();
        return $users;
    }
	
	public function headings(): array
    {
        return ['Id','Name','Email','Address','City','State','Country', 'Pin code','Mobile','verify','admin','Status','created_at','updated_at'];
    }
}
