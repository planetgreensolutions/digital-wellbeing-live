<?php
namespace App\Models\Admodels;
use App\Traits\Admin\FilterTrait;
use App\Traits\DataTrait;
use DB;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Description of UserModel
 *
 * @author The Oracle
 */
class CharterPledgeRegistrationModel extends Model implements AuditableContract {

	use \OwenIt\Auditing\Auditable;

	use FilterTrait;

	protected $table = 'charter_pledge_registration';

	protected $primaryKey = 'cpr_id';

	protected $fillable = [
		'user_agent_string',
		'cpr_hash',
		'cpr_name',
		'cpr_email_address',
		'cpr_lang',
		'cpr_nationality',
		'cpr_age',
		'created_at',
		'updated_at',
	];

	private static $filters = [
		'filter_cpr_name' => ['q' => 'like', 'type' => 'text', 'title' => 'User Name'],
		'filter_cpr_email_address' => ['q' => '=', 'type' => 'text', 'title' => 'Email Address', 'model' => ''],
	];

	public function getName() {
		return $this->cpr_name;
	}

	public function getEmailAddress() {
		return $this->cpr_email_address;
	}

	public function getLang() {
		return $this->cpr_lang;
	}

	public function getNationality() {
		return $this->belongsTo('App\Models\Admodels\CountryModel', 'cpr_nationality', 'country_id');
	}

	public function getAge() {
		return $this->cpr_age;
	}

}