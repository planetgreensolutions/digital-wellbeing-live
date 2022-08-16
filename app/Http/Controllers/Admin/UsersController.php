<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Admin\Base\AdminBaseController;
use Illuminate\Support\Facades\Redirect;
use App\User as User;
use Auth;
use Input;
use Config;
use Session;
use DB;
use Illuminate\Support\Facades\Validator;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Admodels\CountryModel;
use App\Models\Admodels\PostModel;

use App\Rules\PasswordStrength;
use App\Rules\SameOldPassword;
use Lang; 

class UsersController extends AdminBaseController {
	
	protected $roleNames;
	protected $rolesObj;
	public function __construct(Request $request){
		parent::__construct($request);
		$this->module = 'User';
		// pre($this->module);
	}

	
	public function index(Request $request){
		
		/* if(!$this->checkPermission('List')){
			return $this->returnInvalidPermission($request);
		} */
		// pre($this->module.'asd');
		if($request->route()->getName() == 'registrations'){
			$users =  User::filter($request)->where('is_admin',2);
			$view = 'admin.registrations.list';
		}else{
			$users =  User::filter($request)->where('is_admin',1);
			$view = 'admin.users.list';
		}
		$this->data['users'] = $users->paginate(50)->appends(Input::except('page'));
		$this->data['countryList'] = CountryModel::where('country_status','=',1)->get();
		//$this->data['filterDOM'] = User::getFilterDom($request);
		$this->data['filterDOM'] ='';
		return view($view,$this->data);
	}
    
    private function _getYearMonths($format='F'){
      $res = [];
      for($m=1; $m<=12; ++$m){
            $res[] = date($format, mktime(0, 0, 0, $m, 1));
      }  
      return $res;
    }
    
    
	public function dashboard(Request $request){
		
		
		$this->data['isDashBoard'] = true;
		$this->data['pageTitle'] = "Dashboard";
		$this->data['digital_domain_count'] = PostModel::where('post_type','=','digital_domains')->active()->count();
		$this->data['resource_count'] = PostModel::where('post_type','=','resources')->active()->count();
		
		return view('admin.dashboard.dashboard',$this->data);
	}

	public function create(Request $request){
        
		if(!$this->checkPermission('Add')){
			return $this->returnInvalidPermission($request);
		}

		if(Input::get('createbtnsubmit')){
		$inputs = [
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'password' => $request->input('password'),
			'user_phone_number' => $request->input('user_phone_number'),
			'status' => $request->input('status'),
			'user_nationality' => $request->input('country_id'),
			'force_password_change' => $request->input('force_password_change'),
		];
		$rules = [
			'name' => 'required',
			'email' => 'required|email',
			'password' => [ 'required' , new PasswordStrength ],
			'user_phone_number' => 'required',
			'status' => 'required',
			'user_nationality' => 'required',
			'force_password_change' => 'required',
			
		];
		

		$messages = [
			'name.required' => 'Name is required',
			'email.required' => 'Email is required',
			'email.email' => 'Invalid Email',
			'password.required' => 'Password is required',
			'user_phone_number.required' => 'Phone number is required',
			'status.required' => 'Status is required',
			'user_nationality.required' => 'Please select atleast one country from the list',
			'force_password_change.required' => 'Force password change us required',
		];
		
		$validator = Validator::make($inputs,$rules,$messages);
			if($validator->fails()){
				$request->flash();
				$messages = $validator->messages();
				
				$userMessages='<ul class="alert alert-danger alert-dismissable">';
				foreach ($messages->all('<li>:message</li>') as $message){
					$userMessages .= $message;
				}

				$userMessages.='</ul></div>';
			    $this->data['userMessage']=$userMessages;
				//return Redirect(apa('users/create'))->with('userMessage',$userMessages);
			}else{
				try{
				
				$inputs['password'] = \Hash::make($inputs['password']);
				$inputs['is_system_account'] = 2;
				$inputs['is_backend_user'] = 1;
				$inputs['is_admin'] = 1;
				if($this->_isRoleSelected('Super Admin',$request)){
					$inputs['is_super_admin'] = 1;
				}

				if($request->file('user_avatar')){
					$uploadPath = 'public/user/';
					$dimension = array(array('folder'=>'','width'=>'400','height'=>'400'));
					$fileName = $this->resize_and_crop_image('user_avatar',$uploadPath ,$dimension,null);
					$arr['user_avatar'] = $fileName;
				}
				
				if($inputs['force_password_change'] == 1){
					$inputs['password_changed'] = 2;
				}

				$user = User::create($inputs); 
				$roles = $request['roles']; 
				if (isset($roles)) {
					foreach ($roles as $role) {
						$role_r = Role::where('id', '=', $role)->firstOrFail();  
						$user->assignRole($role_r); //Assigning role to user
					}

       			}
   
				/* $memberRole = Role::where('name','=','Website Member')->first();
				$user->assignRole($memberRole); */
				$userMessages ='<div class="alert alert-success alert-dismissable">User Account created</div>';
				}catch( \Illuminate\Database\QueryException $e ){
					\Input::flash();
					
					$errorInfo = $e->errorInfo;
                    if($errorInfo[0] == 23000){
                        $userMessages ='<div class="alert alert-danger alert-dismissable">User Account already exist.'.$e->getMessage().'</div>';
                    }

				}
	            $this->data['userMessage']=$userMessages;
				//return redirect(apa('users/create'))->with('userMessage',$userMessages);
			}

		}
        
		$this->data['roles'] = Role::get();
		$this->data['countryList'] = CountryModel::where('country_status','=',1)->get();
        return view('admin.users.add',$this->data);
	}

	public function edit($editID, Request $request){
		
		/* if(!$this->checkPermission('Edit')){
			return $this->returnInvalidPermission($request);
		} */
		// pre('asd');

		$userOrRegistrations = 'users';
		$view = 'admin.users.edit';
		if($request->route()->getName() == 'registration_edit'){
			$userOrRegistrations =  'registrations';
			$view = 'admin.registrations.edit';
			}

		if(empty($editID)) { return redirect()->to(apa($userOrRegistrations));}

		$user = User::findOrFail($editID);
		if(empty($user)){
			return redirect()->to(apa($userOrRegistrations));
		}

		/**/ if( $user->hasRole('Super Admin') && !Auth::user()->hasRole('Super Admin') ) { 
			return Redirect(route('admin_dashboard'))->with('userMessage','Invalid Permission');
		}
 
		$this->data['messages']='';
		if(Input::get('updatebtnsubmit')){
		$inputs = [
			'name' => $request->input('name'),
			'user_phone_number' => $request->input('user_phone_number'),
			'status' => $request->input('status'),
			'user_nationality' => $request->input('country_id'),
			'current_admin_pass' => $request->input('current_admin_pass'),
			'force_password_change' => $request->input('force_password_change'),
		];
		
		$rules = [
			'name' => 'required',
			'user_phone_number' => 'required',
			'status' => 'required',
			'user_nationality' => 'required',
			'current_admin_pass' => 'required',
			'force_password_change' => 'required',
		];
		
		if(Input::get('password')){
			$inputs['password'] = Input::get('password');
			$rules['password'] = [ new PasswordStrength ];
		}	
		
		if($user->is_system_account == 1) {
			unset($rules['status']);
		}


		$messages = [
			'name.required' => 'Name is required',
			'user_phone_number.required' => 'Phone number is required',
			'status.required' => 'Status is required',
			'current_admin_pass.required' => 'Current Admin Password is required',
			'user_nationality.required' => 'Please select atleast one country from the list',
			'force_password_change.required' => 'Force password change us required',
		];
		$validator = Validator::make($inputs, $rules, $messages);
			if($validator->fails()){
				$request->flash();
				$messages = $validator->messages();
				$userMessages =$this->custom_message('Fields are mandatory!','error');
				$userMessages ='<div><ul class=" alert alert-danger alert-dismissable">';
				foreach ($messages->all('<li>:message</li>') as $message){
					$userMessages .= $message;
				}

				$userMessages.='</ul></div>';
				$this->data['userMessage']=$userMessages;
				//return Redirect(apa($userOrRegistrations.'/edit/'.$editID))->with('userMessage',$userMessages);
			}else{
				
				if($inputs['force_password_change'] == 1){
					$inputs['password_changed'] = 2;
				}
				
				if(!\Hash::check($inputs['current_admin_pass'], Auth::user()->password)){
					$userMessages = '<div class="alert alert-danger alert-dismissable">Current Password mismatch!!</div>';
					$this->data['userMessage']=$userMessages;
					//return Redirect(apa($userOrRegistrations.'/edit/'.$editID))->with('userMessage',$userMessages);
				}else{

				if(Input::get('password')){
					$inputs['password'] = \Hash::make(Input::get('password'));
				}

				if($request->file('user_avatar')){
					$uploadPath = 'public/user/';
					$dimension = array(array('folder'=>'','width'=>'400','height'=>'400'));
					$fileName = $this->resize_and_crop_image('user_avatar',$uploadPath ,$dimension,null);
					$inputs['user_avatar'] = $fileName;
				}

				unset($inputs['current_admin_pass']);
				
				if($user->is_system_account == 1) {
					unset($inputs['status']);
				}

				$user->fill($inputs)->save();
				
				
					$roles = $request['roles']; //Retreive all roles
					if (isset($roles)) {  
						$user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
					}else {
						
						$user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
					}

				
				$userMessages = '<div class="alert alert-success alert-dismissable">User updated successfully</div>';
				$this->data['userMessage']=$userMessages;
				//return Redirect(apa($userOrRegistrations.'/edit/'.$editID))->with('userMessage',$userMessages);
				}
			}

		}

		$this->data['user'] = DB::table('users')->where('id','=',$editID)->get();
		$this->data['countryList'] = CountryModel::where('country_status','=',1)->get();
		$this->data['roles'] = Role::get(); 
		$userRoleIDs = array('-1');

		foreach($user->roles as $role){
			$userRoleIDs[] = $role->id;
		}

		$this->data['userRoleIDs'] = $userRoleIDs;
		$this->data['user'] = User::findOrFail($editID);
		$this->data['countryList'] = CountryModel::where('country_status','=',1)->get();
		return view($view,$this->data);
	}


	public function admin_errorpage(){
		return view('admin.error.errorpage',$this->data);
	}

	public function changestatus(Request $request,$statusID,$currentStatus){
	
		if(!$this->checkPermission('Edit')){
			return $this->returnInvalidPermission($request);
		}


		$userOrRegistrations = 'users';
		if($request->route()->getName() == 'registration_change_status'){
			$userOrRegistrations =  'registrations';
		}
		
		$currentStatus = ($currentStatus==2)?1:2;
		$currentStatusdatas = array("status"=>$currentStatus);
		$userObj = User::where('id', '=',$statusID)->first();
		$userObj->update($currentStatusdatas);
		return redirect()->to(apa($userOrRegistrations))->with('userMessage','Status Changed');
	}

	public function delete($deleteID){
		
		if(!$this->checkPermission('Delete')){
			return $this->returnInvalidPermission($request);
		}

		
		if(empty($deleteID)) { return redirect()->to(apa('users'));}

		$user = User::find($deleteID);
		$user->delete();
		return redirect()->to(apa('users'))->with('userMessage','User account deleted');
	}
	 
	 
	 
public function getUserDetails(Request $request){
	
	if($request->ajax()){
		
		if(empty($request->input('id'))){
			return \Response::json(array('status'=>false,'data'=>null,'message'=>'No user details found!'));
		}
		
		$id = $request->input('id');
		
		if($request->route()->getName() == 'registration_details'){
			
			$details = User::filter($request)->where('id',$id)->first();
			// pre($details->toArray());
			$this->data['details'] = $details;
			
			$dom = View('admin.registrations.user_details',$this->data)->render();
			
			return \Response::json(array('status'=>true,'dom'=>$dom,'message'=>'User Found.'));
		}
		
		
	}
	
	
	}
	
	
	private function _isRoleSelected($roleName = 'Manage Web',$request){
		if(empty($request->input('roles'))){
			return false;
		}

		$roleIndex = str_replace(' ','_',$roleName);
		if(!$this->rolesObj || !isset($this->rolesObj[$roleIndex])){
			$this->rolesObj[$roleIndex] = Role::select('id')->where('name','=',$roleName)->first();
		}

		return (in_array($this->rolesObj[$roleIndex]->id,$request->input('roles')));
	}
	
	public function changePassword(Request $request)
	{
	 
		$user = \Auth::user();
		if(empty($user)){
			return redirect()->to(apa('dashboard'));
		}
 
		$this->data['messages']='';
		if($request->input('updatebtnsubmit'))
		{
			$inputs = [
				'name' => $request->input('name'),
				'user_phone_number' => $request->input('user_phone_number'),
				'current_admin_pass' => $request->input('current_admin_pass'),
			];
			$rules = [
				'name' => 'required',
				'user_phone_number' => 'required',
				'current_admin_pass' => 'required',
			];
			
			if(Input::get('password')){
				$inputs['password'] = Input::get('password');
				$rules['password'] = [ new PasswordStrength ];
			}	
			
			$messages = [
				'name.required' => 'Name is required',
				'user_phone_number.required' => 'Phone number is required',
				'status.required' => 'Status is required',
				'current_admin_pass.required' => 'current Admin Password is required',
				'allotted_hubs.required' => 'Please Select atleast one hub from the list'
			];
			
			$validator = Validator::make($inputs, $rules, $messages);
			
			if($validator->fails())
			{
				$request->flash();
				$messages = $validator->messages();
				$userMessages =$this->custom_message('Fields are mandatory!','error');
				$userMessages .='<ul class="validation_errors">';
				foreach ($messages->all('<li>:message</li>') as $message){
					$userMessages .= $message;
				}

				$userMessages.='</ul></div>';
				return Redirect(apa('change_password'))->with('userMessage',$userMessages);
			}
			else
			{
				if(!\Hash::check($inputs['current_admin_pass'], Auth::user()->password)){
					$userMessages = '<div class="alert alert-danger">Current Password mismatch!!</div>';
					return Redirect(apa('change_password'))->with('userMessage',$userMessages);
				}

				if(Input::get('password')){
					$inputs['password'] = \Hash::make(Input::get('password'));
				}

				unset($inputs['current_admin_pass']);

				$user->fill($inputs)->save();
				$userMessages = '<div class="alert alert-success">User Details updated successfully</div>';
				return Redirect(apa('change_password'))->with('userMessage',$userMessages);
			}

		}

		$this->data['user'] = $user;
		return view('admin.users.change_password',$this->data);
	}
}
 