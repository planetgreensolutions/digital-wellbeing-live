<?php

namespace App\Exports;

use App\User;
use App\Models\Admodels\ReportModel;

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

class ReportRequestExport implements FromView, ShouldAutoSize
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
		$report_request=ReportModel::orderBy('report_created_at','desc');
		
		/*
		if(!empty($this->filter->filter_reg_name)){
			$report_request->where('report_name','LIKE','%'.$this->filter->filter_reg_name.'%');
		}
		if(!empty($this->filter->filter_reg_email)){
			$report_request->where('report_email',$this->filter->filter_reg_email);
		}
		if(!empty($this->filter->filter_reg_date_from)){
			$report_request->whereRaw('DATE(report_created_at) >= "'.date('Y-m-d',strtotime($this->filter->filter_reg_date_from)).'"');
		}
		if(!empty($this->filter->filter_reg_date_to)){
			$report_request->whereRaw('DATE(report_created_at) <= "'.date('Y-m-d',strtotime($this->filter->filter_reg_date_to)).'"');
		}
		*/
		
		$reportRequest=$report_request->get();
		$template = ($type == 'excel') ? 'admin.contact.report_export' : 'admin.contact.report_export';
        return view($template, ['report' => $reportRequest]);
    }
	
	
}