<?php

namespace App\Exports;

use App\User;
use App\Models\Admodels\ContactModel;

use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use \App\ExcelHelper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ContactRequestExport implements FromView, ShouldAutoSize
{
	
	protected $request;
	
	public function __construct($request){
		$this->request = $request;
	}
	public function registerEvents(): View{
        return [
            AfterSheet::class => function(AfterSheet $excel) {
				 $sheet->setFontSize(12);
				
				
            },
        ];
    }
	
    public function view(): View{
		$type = 'excel';
		$contact_request=ContactModel::orderBy('contact_created_at','desc');
		
		
		if(!empty($this->filter->filter_reg_name)){
			$contact_request->where('contact_name','LIKE','%'.$this->filter->filter_reg_name.'%');
		}
		if(!empty($this->filter->filter_reg_email)){
			$contact_request->where('contact_email',$this->filter->filter_reg_email);
		}
		if(!empty($this->filter->filter_reg_date_from)){
			$contact_request->whereRaw('DATE(contact_created_at) >= "'.date('Y-m-d',strtotime($this->filter->filter_reg_date_from)).'"');
		}
		if(!empty($this->filter->filter_reg_date_to)){
			$contact_request->whereRaw('DATE(contact_created_at) <= "'.date('Y-m-d',strtotime($this->filter->filter_reg_date_to)).'"');
		}
		
		$contactRequest=$contact_request->get();
		$template = ($type == 'excel') ? 'admin.contact.contact_export' : 'admin.contact.contact_export';
        return view($template, ['contact' => $contactRequest]);
    }
	
	
}