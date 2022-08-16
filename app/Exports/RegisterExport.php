<?php

namespace App\Exports;

use App\Models\Admodels\EnquiryModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\User;

class RegisterExport implements FromView
{
	protected $request;
	
	public function __construct($request){
		$this->request = $request;
	}
	
    public function view(): View{

		$this->data['users'] = User::filter(function($queryObj,$filter,$value){
								$model = $filter['model'];
									if(isset($model['title_key'])){
										$filterField = $model['title_key'];
										$queryObj->whereHas('formSubmissions',function($q) use($value){
											$q->where('form_manager_id',$value);
										});
									}
								})
								->with(['formSubmissions'=>function($q){
									$q->where('form_status','=',1);
								}])
								->orderBy('created_at','desc')
								->where('is_admin','<>',1)
								->paginate(20);
		
		$template ='admin.registrations.export.register_export_excel';
        return view($template, $this->data);
    }
	
	
}