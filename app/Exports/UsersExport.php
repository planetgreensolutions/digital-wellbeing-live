<?php
namespace App\Exports;

use App\Models\Admodels\RegistrationModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
	protected $request;
	
	public function __construct($request){
		$this->request = $request;

	}
    public function view(): View
    {
		$type = $this->request->input('type');
		$type = ($type) ? $type : 'excel';

		$isZip = $this->request->input('zip');
		
		$userTmp = RegistrationModel::filter();
	
		if(!empty($this->request->input('registrationID'))){
			$userTmp->where('id',$this->request->input('registrationID'));
		}
		
		$user = $userTmp->get();
		$template = ($type == 'excel') ? 'admin.initiative_registration.exports.excel_export' : 'admin.initiative_registration.exports.pdf_export';
		
        return view($template, ['users' => $user]);
    }
	
}
