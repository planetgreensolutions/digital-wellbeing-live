<?php
namespace App\Models\Admodels;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DataTrait;
class ReportModel extends Model {

		protected $table = 'report';

        protected $primaryKey = 'report_id';
        use DataTrait;
		protected $fillable =  [ 
		                            'report_by',
		                            'report_name',
									'report_email',
									'report_message',
									'report_data',
                                ];
		const CREATED_AT = 'report_created_at';

        const UPDATED_AT = 'report_updated_at';

}