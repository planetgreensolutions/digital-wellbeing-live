<?php
namespace App\Models\Admodels;

use Illuminate\Database\Eloquent\Model;

use DB;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ViewBuilderModel extends Model implements AuditableContract {
		
		use \OwenIt\Auditing\Auditable;
		
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */

		protected $table = 'view_builder_master';

		protected $primaryKey = 'id';



		protected $fillable = ['vbm_title','vbm_slug','vbm_has_arabic','vbm_is_single','vbm_created_by','vbm_updated_by'];

		 const CREATED_AT = 'vbm_created_at';

		 const UPDATED_AT = 'vbm_updated_at';


         
         
        protected function getView($slug){
            return DB::table('view_builder_master')->where('vbm_slug','=',$slug)->first();            
        }





}