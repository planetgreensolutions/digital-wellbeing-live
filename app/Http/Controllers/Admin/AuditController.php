<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Base\AdminBaseController;
use Validator, Input, Redirect,Auth,Config,DB;
use Illuminate\Support\Facades\Gate;
use App\User as User;
use Illuminate\Http\Request;
use File;
use View;
use App\Models\Admodels\AuditModel;

class AuditController extends AdminBaseController {
	
	
	
	public function __construct(Request $request){

		parent::__construct($request);
		$this->roleNames = ['Super Admin'];
	}
	

	
	public function index(Request $request){
		
		 if( !$this->userObj->hasAnyRole($this->roleNames) ){
			return $this->returnInvalidPermission($request);
		} 
		
		$this->data['auditList']= AuditModel::with('user')
									->orderBy('created_at','desc')
									->paginate(100);				
		return view::make('admin.audit_logs.list',$this->data);		 
	}
	
}