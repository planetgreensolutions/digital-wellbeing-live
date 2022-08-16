<?php
namespace App\Models\Admodels;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DataTrait;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class GalleryModel extends Model implements AuditableContract {

		use \OwenIt\Auditing\Auditable;
        
		protected $table = 'gallery_images';

        protected $primaryKey = 'gallery_id';
        use DataTrait;

		protected $fillable =  [ 
		 'gallery_post_id',
                                    'gallery_category_slug',
									'gallery_image_name',
									'gallery_image_title',
									'gallery_image_name_arabic',
									'gallery_image_date',
									'gallery_image_type', 
									'gallery_image_show_home', 
									'gallery_image_status',
									'youtube_video',
									'youtube_video_thumbnail',
									'gallery_priority',
                                ];

        public function mediaPost(){
            return $this->belongsTo('App\Models\Admodels\PostModel','post_id','gallery_post_id');
        }
      
        
       


}