<?php
namespace App\Models\Admodels;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\FilterTrait;
use App\Traits\DataTrait;
use DB;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
/**
 * Description of UserModel
 *
 * @author The Oracle
 */
class RegistrationModel extends Model implements AuditableContract{
	
	use \OwenIt\Auditing\Auditable;
	
	use FilterTrait;
	
	protected $table ='initiative_registration';
	
	protected $primaryKey = 'ir_id';
	
	protected $fillable = [
		'ir_initiative_id',
		'ir_name',
		'ir_email',
		'ir_entity_name',
		'ir_phone_number',
		'ir_message',
	];
	
	private static $filters =[
			'filter_ir_name' => ['q'=>'like','type'=>'text','title'=>'name'],
			'filter_ir_email' => ['q'=> '=','type'=>'text','title'=>'email','model'=>''],
			'filter_ir_entity_name' => ['q'=> 'like','type'=>'text','model'=>'','title'=>'entity_name'],
			'filter_initiative' => ['q'=> '=','type'=>'select','model'=>['src'=>'App\Models\Admodels\PostModel','title_key'=>'post_title','foreign'=>true,'post_collection'=>'initiatives'],'title'=>'initiative'],
			/* add more here */
		];
    
	public function initiative(){
		return $this->hasOne('App\Models\Admodels\PostModel','post_id','ir_initiative_id');
	}
 
}
