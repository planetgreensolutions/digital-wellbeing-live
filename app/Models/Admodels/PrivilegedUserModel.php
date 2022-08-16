<?php

namespace App\Models\Admodels;

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

class PrivilegedUserModel extends Authenticatable  implements AuditableContract
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
	
	protected $table = 'privileged_users';

	protected $primaryKey = 'id';
     
	protected $fillable = [		
			"status",
			"name",
			"user_nationality",
			"user_first_name",
			"user_middle_name",
			"user_last_name",
			"user_first_name_ar",
			"user_middle_name_ar",
			"user_last_name_ar",
			"username",
			"email",
			"user_email_confirmed",
			"user_confirm_email_sent",
			"password",
			"user_gender",
			"user_title",
			"user_entity",
			"remember_token",
			"country_code",
			"user_phone_number",
			"user_emirate",
			"user_address",
			"created_at",
			"updated_at",
			"user_validate_code",
			"user_avatar",
			"user_dob",
			"last_logged_in",
			"force_password_change",
			"password_changed",
			"is_super_admin"
			
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
		'filter_name' => ['q'=>'like','type'=>'text','title'=>'Name'],
		'filter_email' => ['q'=> '=','type'=>'text','title'=>'Email','model'=>''],
		
		'filter_user_nationality' => ['q'=> '=','type'=>'select','model'=>['src'=>'App\Models\Admodels\CountryModel','title_key'=>'country_name','foreign'=>false],'title'=>'Nationality'],
		'filter_formSubmissions' => ['q'=> 'custom','type'=>'select','model'=>['src'=>'App\Models\FormManagerModel','title_key'=>'fm_sub_category_en','foreign'=>true],'title'=>'Form Type'],
		// 'filter_roles' => ['q'=> '=','type'=>'select','model'=>['src'=>'Spatie\Permission\Models\Role','title_key'=>'name','foreign'=>true],'title'=>'Role'],
		// 'filter_user_email_confirmed' => ['q'=> '=','type'=>'select','model'=>['src'=>'App\Models\Admodels\YesNoModel','title_key'=>'yn_label','foreign'=>false],'title'=>'Email Confirmed'],
		/* add more here */
		'filter_status' => ['q'=> '=','type'=>'select','model'=>'','title'=>'Status','data'=>['1'=>'Active','2'=>'Inactive']],
	];
    

	
    public static function boot() {
        parent::boot();

        static::deleting(function($user) {
            
        });
    }
    
    public function isAdmin()    {        
        return $this->is_admin === self::ADMIN_TYPE;    
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
	
	
	
	
	
	

   
}
