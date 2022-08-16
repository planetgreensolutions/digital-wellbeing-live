<?php
namespace App\Exports;

use App\Models\Admodels\NominationModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class NominationExport implements WithMultipleSheets
{
	use Exportable;
	protected $request;
	
	public function __construct($request){
		$this->request = $request;

	}
	
	public function sheets(): array
    {
        $sheets = [];
		$usersTmp = NominationModel::filter();
	
		if(!empty($this->request->input('id'))){
			$usersTmp->where('no_id',$this->request->input('id'));
		}
		
		$users = $usersTmp->get();
		foreach($users as $user){ 
			$sheets['user'] = collect($user);
			$sheets['nomin'] = new NominationSheet($user,$this->request);
		}
		
        /* for ($month = 1; $month <= 12; $month++) {
            $sheets[] = $;
        } */

        return $sheets;
    }
	
   /*  public function view(): View
    {
		$type = $this->request->input('type');
		$type = ($type) ? $type : 'excel';
		
		$isZip = $this->request->input('zip');
		
		$userTmp = NominationModel::filter();
	
		if(!empty($this->request->input('id'))){
			$userTmp->where('no_id',$this->request->input('id'));
		}
		
		$user = $userTmp->get();
		pre($user);
		$template = ($type == 'excel') ? 'admin.initiative_registration.exports.excel_export' : 'admin.initiative_registration.exports.pdf_export';
		
        return view($template, ['users' => $user]);
    } */
	
}
