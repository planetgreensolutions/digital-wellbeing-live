<?php
namespace App\Models\Admodels;

use DB;
use Illuminate\Database\Eloquent\Model;
use \App\Traits\DataTrait;

class CountryModel extends Model {
	use DataTrait;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'country';
	protected $primaryKey = 'country_id';

	protected $fillable = ['country_name', 'iso', 'name', 'country_name_arabic', 'iso3', 'numcode', 'phonecode', 'country_status'];
	//protected $fillable = ['test'];

	const CREATED_AT = 'country_created_at';
	const UPDATED_AT = 'country_updated_at';

	public function getId() {
		return $this->country_id;
	}

	public function getName() {
		return $this->getData('country_name');
	}

}