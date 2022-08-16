<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Base\AdminBaseController;
use App\User as User;
use Auth;
use Input;
use Config;
use Illuminate\Http\Request;

class LoginController extends AdminBaseController {
	
    public function __construct(Request $request){

		 parent::__construct($request);
	}

	public function index(Request $request){
		
		
		if(Auth::user() ) return redirect()->to(Config::get('app.admin_prefix').'/dashboard');
		
		// session()->pull('login_tries');
		
		$loginTries = session('login_tries');
				
		$lastTriedAt = session('last_tried_at');
		
		$loginTries = (empty($loginTries))?0:$loginTries;
		
		if( $loginTries >= 3 ){
			return redirect()->to('/')->with('errorMessage',lang('invalid_request'));
		}

		
		$this->data['message']='';
		if(Input::get('user_email')){
			$inputs = [
				'email'=>Input::get('user_email'),
				'password'=>Input::get('password'),
				 'captcha'=>Input::get('g-recaptcha-response'),
			];
			$rules = [
				'email' => 'required',
				'password' => 'required',
				 'captcha' => 'required',
			];
			
			$messages = [
				'email.required' => 'Email is required',
				'password.required' => 'Password is required',
				'captcha.required' => 'Captcha is required',
				// 'captcha.recaptcha' => 'Invalid captcha',
			];
			
			$validator = \Validator::make($inputs,$rules,$messages);
			if($validator->fails()){
                $request->flash();
				$errors = '<ul class="alert alert-danger">';
				$messages = $validator->messages()->all();
				foreach($messages as $message){
					$errors .= '<li>'.$message.'</li>';
				}
				$errors .= '</ul>';
				$this->data['userMessage']=$errors;
			}else{
			
				// $credentials = array('email' => Input::get('user_email'), 'password' => Input::get('password'),'is_admin'=>1,'status'=>1);
				$credentials = array('email' => Input::get('user_email'), 'password' => Input::get('password'),'status'=>1);
				
				
				if(Auth::attempt($credentials)){
					$user = User::where('id','=',Auth::user()->id)->first();
					
                    $user->update(['last_logged_in'=>\Carbon\Carbon::now()->toDateTimeString()]);
					
					if($user->hasRole('Country Coordinator')){
						\App::setLocale('ar');
					}else{
						\App::setLocale('en');
					}
						
					return redirect()->to(Config::get('app.admin_prefix').'/dashboard');
				}else{
					
					$loginTries += 1;
					
					session(['login_tries'=>$loginTries]);
					// pre($loginTries);
					// pre(session('login_tries'));
					session(['last_tried_at'=>date('Y-m-d H:i:s')]);
					
					$this->data['userMessage']= $this->custom_message("Invalid Username & Password",'error');
					
					// $this->data['attemptsLeft'] = 3 - $loginTries;
				}
				
			}
		}
		$this->data['pageTitle'] .="Login";
		if( $loginTries >= 3){
			return redirect()->to('/')->with('errorMessage',lang('invalid_request'));
		}
		return view('admin.users.login',$this->data);
	}
	
	public function logout(){
	 	Auth::logout();
		\Session::flush();
		return redirect()->to(Config::get('app.admin_prefix').'');
	}

	public function create_admin_account(){
		//if admin account exist then redirect to login
		if(!User::admin_exist()){
			return redirect()->to(Config::get('app.admin_prefix').'/');
		}
		// die('asd');
		$this->data['pageTitle'] = 'Create Admin Account';
		if(\Request::isMethod('post')){
			$validation = \Validator::make(
				array(
					'name' => Input::get( 'fname' ),
					'email' => Input::get( 'aemail' ),
					'username' => Input::get( 'aemail' ),
					'password' => Input::get( 'apass' ),
					'password_confirmation' => Input::get( 'acpass' ),
				),
				array(
					 'name' => array( 'required' ),
					'email' => array( 'required', 'email' ),
					 'username' => array( 'required' ),
					'password' => array( 'required', 'confirmed' ),
					'password_confirmation' => array( 'required' ),
				)
			);

			if( !$validation->fails() ){
				// $password = $this->get_password_hash(Input::get( 'password' ));
				$password = \Hash::make(Input::get( 'acpass' ));
				$user = new User;
				$user->name = Input::get('fname').Input::get('lname');
				$user->username = Input::get('aemail');
				$user->email = Input::get('aemail');
				$user->password = $password;
				$user->is_admin = 1;
				$user->status = 1;
				$user->save();
				return redirect()->to(Config::get('app.admin_prefix').'/')->with('userMessage','Admin account created. Please login with your credentials.');
			}else{
				Input::flash();
				$this->data['message'] = $validation->messages();
			}
		}

		return view('admin.users.create',$this->data);
	}
}
