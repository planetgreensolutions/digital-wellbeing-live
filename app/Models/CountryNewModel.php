<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

use \App\Traits\DataTrait;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class CountryNewModel extends Model implements AuditableContract {
	use DataTrait;
	use \OwenIt\Auditing\Auditable;
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */

		protected $table = 'country';

		protected $primaryKey = 'country_id';



		protected $fillable = ['country_name','iso','name','country_name_arabic','iso3','numcode','phonecode','country_status'];
		//protected $fillable = ['test'];

		 const CREATED_AT = 'country_created_at';

		 const UPDATED_AT = 'country_updated_at';








}