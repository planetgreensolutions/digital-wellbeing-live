<?php
namespace App\Models\Admodels;

use Illuminate\Database\Eloquent\Model;

use DB;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ViewBuilderDetailsModel extends Model implements AuditableContract {
		
		use \OwenIt\Auditing\Auditable;
		
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */

		protected $table = 'view_builder_details';

		protected $primaryKey = 'vbd_id';



		protected $fillable = ['vbd_title','vbd_vbm_slug','vbd_type','vbd_required','vbd_arabic_counterpart','vbd_created_by','vbd_updated_by'];

		 const CREATED_AT = 'vbd_created_at';

		 const UPDATED_AT = 'vbd_updated_at';


         
         

        protected function getFields($slug){
            return DB::table('view_builder_details')->where('vbd_vbm_slug','=',$slug)->get();            
        }




}