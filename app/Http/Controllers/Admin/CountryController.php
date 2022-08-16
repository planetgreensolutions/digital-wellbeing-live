<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Base\AdminBaseController;
use Validator, Input, Redirect,Auth,Config,DB;
use Illuminate\Support\Facades\Gate;
use App\User as User;
use Illuminate\Http\Request;
use File;
use View;
use App\Models\CountryNewModel;

class CountryController extends AdminBaseController {
	
	protected $roleName;
	public function __construct(Request $request){

		 parent::__construct($request);
		$this->roleNames = ['Super Admin','Country Manager'];
	}
	

	
	public function index(){
		// pre($this->data);
		 if( !$this->userObj->hasAnyRole($this->roleNames) ){
			return Redirect(route('admin_dashboard'))->with('userMessage','Invalid Permission') ;
		} /**/
		
		$this->data['countryList']= CountryNewModel::								
									orderBy('country_name','asc')
									->paginate(350);				
		return View::make('admin.country.list',$this->data);		 
	}
	
	public function create(Request $request){	
		
		
		if(!$this->checkPermission('Create Country')){
			return Redirect(route('admin_dashboard'))->with('userMessage','Invalid Permission') ;
		}
		
		$this->data['messages']='';
		if($request->input('createbtnsubmit')){
				$file = Input::file('country_image_name');
				$insertDatas = array();
					$insertDatas = array(
									'country_name' =>$request->input('country_name'),
									'country_name_arabic' =>$request->input('country_name_arabic'),
									'iso' =>$request->input('country_iso'),
									'iso3' =>$request->input('country_iso_3'),
									'country_status' =>$request->input('country_status'),					
				 				);
				
				$newCountry  = CountryNewModel::create($insertDatas);
				$this->data['userMessage'] =$this->custom_message('Country Added Successfully','success');		
			}
			
		 return View::make('admin.country.add',$this->data);			 
	}

	public function update($editID, Request $request){	 
	
	
		if(!$this->checkPermission('Edit Country')){
			return Redirect(route('admin_dashboard'))->with('userMessage','Invalid Permission') ;
		}
		
		
		if(empty($editID)) { return redirect()->to(Config::get('app.admin_prefix').'/country');}		
		$this->data['messages']	='';
		if($request->input('updatebtnsubmit')){		
				$file = Input::file('country_image_name');		
				$this->datasupdate = array(
									'country_name' =>$request->input('country_name'),
									'country_name_arabic' =>$request->input('country_name_arabic'),
									'iso' =>$request->input('country_iso'),
									'iso3' =>$request->input('country_iso_3'),
									'country_status' =>$request->input('country_status'),
									);
				
				$country = CountryNewModel::where('country_id', '=',$editID)->first();
				$country->update($this->datasupdate);
				$this->data['userMessage'] = $this->custom_message('Country updated successfully','success');		
			}
		
     $this->data['countryDetails'] = DB::table('country')->where('country_id','=',$editID)->first();
	 return View::make('admin.country.edit',$this->data);			 
  }

	public function changestatus($statusID,$currentStatus){
		
		if(!$this->checkPermission('Edit Country')){
			return Redirect(route('admin_dashboard'))->with('userMessage','Invalid Permission') ;
		}
		
		
		$currentStatus = ($currentStatus==0)?1:0;
		$currentStatusdatas = array("country_status"=>$currentStatus);
		$country = CountryNewModel::where('country_id', '=',$statusID)->first();
		$country->update($currentStatusdatas);	
		return redirect()->to(Config::get('app.admin_prefix').'/country')->with('userMessage','Status changed');
	}
	
	public function delete($deleteID){	 
		
		if(!$this->checkPermission('Delete Country')){
			return Redirect(route('admin_dashboard'))->with('userMessage','Invalid Permission') ;
		}
		
		
		if( !$this->userObj->hasRole($this->roleName) ){
			return Redirect(route('admin_dashboard'))->with('userMessage','Invalid Permission') ;
		}
		
		if(empty($deleteID)) { return redirect()->to(Config::get('app.admin_prefix').'/country');}
		 $country = CountryNewModel::where('country_id', '=',$deleteID)->first();
		  $country->delete();	
		 $this->data['messages'] = $this->custom_message('Deleted Successfully','success');
		 return redirect()->to(Config::get('app.admin_prefix').'/country')->with('flash_error','deleted');
	 }	 
	
	


}