<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

use DB;
use App\Traits\DataTrait;
use App\Traits\Admin\FilterTrait;
use App\Traits\PGSMetable;


use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class User extends Authenticatable  implements AuditableContract
{
    use DataTrait,FilterTrait;
	use Notifiable;
    use HasRoles, HasApiTokens;
	use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	const ADMIN_TYPE = 1;
     
	protected $fillable = [		
			"status",
			'password',
			"user_prefix",
			"name",
			"username",
			"email",
			"phone_no",
			"dob",
			"gender",
			"place_of_residence",
			"password",
			"user_phone_number",
			"user_nationality",
			"is_admin",
			"user_approved_by",
			"created_at",
			"updated_at",
			"user_validate_code",
			"last_logged_in",
			"user_avatar",
			"country_code",
			"user_phone_confirmed",
			"user_confirm_email_sent",
			"user_email_confirmed",
			"remember_token",
			"accept_terms",
			"is_super_admin",
			"is_backend_user",
			"is_system_account",
			"user_first_name",
			"user_last_name",
			"user_title",
			"user_entity",
			'force_password_change',
			'password_changed'
			
	];

	protected $auditExclude = [
        'password',
    ];
		
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	
	private static $filters =[
			'filter_name' => ['q'=>'like','type'=>'text','title'=>'name'],
			'filter_email' => ['q'=> '=','type'=>'text','title'=>'email','model'=>''],
			
			'filter_user_nationality' => ['q'=> '=','type'=>'select','model'=>['src'=>'App\Models\Admodels\CountryModel','title_key'=>'country_name','foreign'=>false],'title'=>'nationality'],
			'filter_formSubmissions' => ['q'=> 'custom','type'=>'select','model'=>['src'=>'App\Models\FormManagerModel','title_key'=>'fm_sub_category_en','foreign'=>true],'title'=>'form_type'],
			// 'filter_roles' => ['q'=> '=','type'=>'select','model'=>['src'=>'Spatie\Permission\Models\Role','title_key'=>'name','foreign'=>true],'title'=>'Role'],
			// 'filter_user_email_confirmed' => ['q'=> '=','type'=>'select','model'=>['src'=>'App\Models\Admodels\YesNoModel','title_key'=>'yn_label','foreign'=>false],'title'=>'Email Confirmed'],
			/* add more here */
			'filter_status' => ['q'=> '=','type'=>'select','model'=>'','title'=>'status','data'=>['1'=>'active','2'=>'inactive']],
		];
    

	
    public static function boot() {
        parent::boot();

        static::deleting(function($user) {
            
        });
    }
	
		
	public function transformAudit(array $data): array
    {
		$action =  \Route::currentRouteAction();
		if($action == 'App\Http\Controllers\Admin\LoginController@index')
		{
			$data['event'] = 'Logged In';
		}
		
        return $data;
    }
    
    public function isAdmin()    {        
        return $this->is_admin === 1;    
    }

     
    public function isEmailConfirmed()    {        
        return ($this->user_email_confirmed == 1);    
    }
    
    public function userNationality(){
        return $this->hasOne('App\Models\Admodels\CountryModel','country_id','user_nationality');
    }
	
    
	public function userEmirate(){
		return $this->hasOne('App\Models\Admodels\EmirateModel','uae_id','user_emirate');
	}
    
	public function formSubmissions(){
		return $this->hasMany('\App\Models\FormModel','form_user_id','id');
	}
	
    public static  function admin_exist(){
        $tmp = User::where('is_admin','=',1)->first();
      
        return empty($tmp);
    }
    
	function calculateAge(){
		$age = '';
		if(!empty($this->user_dob)){
			$tz  = new \DateTimeZone('Asia/Dubai');
			$age = \DateTime::createFromFormat('Y-m-d', $this->user_dob, $tz)
			 ->diff(new \DateTime('now', $tz))
			 ->y;
		}
		return $age;
	}
	
	
	
	
	
	public static function getAllUsers($request,$paginate=null){
			
					
		 $tmp= User::where('id','<>',null)->where('is_admin',2);
		
		
		if(!empty($request->name)){
		
			$tmp->where('name','LIKE','%'.$request->name.'%');
		}
		 
		 if(!empty($request->email)){
			$tmp->where('email',$request->email);
		}
		if(!empty($request->country)){
			$tmp->where('place_of_residence',$request->country);
		}
		
		if(!empty($request->email_confirmed)){
			$tmp->where('user_email_confirmed',$request->email_confirmed);
		}
	
		if(!empty($request->datefrom)){
			$tmp->whereRaw('DATE(created_at) >= "'.date('Y-m-d',strtotime($request->datefrom)).'"');
		}
		
		if(!empty($request->dateto)){
			$tmp->whereRaw('DATE(created_at) <= "'.date('Y-m-d',strtotime($request->dateto)).'"');
		}
		
		if(!empty($request->status)){
			$tmp->where('status',$request->status);
		}
		
		
		if(!empty($request->filter_reg_org_name)){
			$tmp->where('user_organization_name','LIKE','%'.$request->filter_reg_org_name.'%');
		}
		
		
		$tmp->groupBy('id');
		$tmp->orderBy('created_at','desc'); 
		
		if(!empty($paginate)){
			return $tmp->paginate(30)->appends(\Input::except('page'));
		}else{
			return $tmp->get();
		}
		
			
	}
	
	
	public function getSubmissionAnchor($class='',$dom = true){
		$count = ($this->formSubmissions) ? $this->formSubmissions->count() : 0	;
		$href= ($count > 0) ? apa('registration/submission-list/'.$this->id) : '#';
		if($dom){
			$anchor = '<a class="'.$class.'" href="'.$href.'">'.$count.'</a>';
		}else{
			$anchor = $href;
		}
		return $anchor;
	}
	
	
	
	

   
}
