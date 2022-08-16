<?php
namespace App\Models\Admodels;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DataTrait;
class ContactModel extends Model {

		
        
		protected $table = 'contact';

        protected $primaryKey = 'contact_id';
        use DataTrait;
		protected $fillable =  [ 
		                            'contact_name',
                                    'contact_lastname',
									'contact_email',
									'contact_phone',
									'contact_subject',
									'contact_message',
                                ];
		const CREATED_AT = 'contact_created_at';

        const UPDATED_AT = 'contact_updated_at';

        
      
        
       


}