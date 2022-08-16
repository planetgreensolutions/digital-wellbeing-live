<?php
namespace App\Models\Admodels;

use Illuminate\Database\Eloquent\Model;

use DB;
use \App\Traits\DataTrait;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class EmirateModel extends Model implements AuditableContract {
	use DataTrait;
	use \OwenIt\Auditing\Auditable;
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */

		protected $table = 'uae_emirates';

		protected $primaryKey = 'uae_id';
        
        public $timestamps = false;

		protected $fillable = ['uae_state_name','uae_state_name_arabic'];
		
}