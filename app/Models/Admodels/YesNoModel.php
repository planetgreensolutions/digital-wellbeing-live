<?php
namespace App\Models\Admodels;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DataTrait;
use DB;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
/**
 * Description of UserModel
 *
 * @author The Oracle
 */
class YesNoModel extends Model implements AuditableContract{
	
	use \OwenIt\Auditing\Auditable;
	
	protected $table ='yes_no';
	
	protected $primaryKey = 'yn_id';
	
	protected $fillable = [];
	
	public $timestamps = false;
	
 
}
