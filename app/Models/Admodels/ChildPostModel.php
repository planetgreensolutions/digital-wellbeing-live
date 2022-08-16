<?php
namespace App\Models\Admodels;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Extension\BaseAppModel;
use Cviebrock\EloquentSluggable\Sluggable;
use \Venturecraft\Revisionable\RevisionableTrait;
// use Plank\Metable\Metable;
use App\Traits\PGSMetable;
use App\Traits\DataTrait;







use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
class ChildPostModel extends Model implements AuditableContract {
		
		use Sluggable, \OwenIt\Auditing\Auditable;
		use RevisionableTrait;
        use \Conner\Tagging\Taggable;        
        use PGSMetable,DataTrait;
		
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		// protected $parent = 'post_category_id';
        
        
		protected $table = 'posts';

        protected $primaryKey = 'post_id';
        
        protected $with = ['meta'];
        
        protected $revisionEnabled = true;
        protected $revisionCreationsEnabled = true;
        protected $historyLimit = 50;
       // protected $revisionCleanup = true; //Remove old revisions (works only when used with $historyLimit)
      

		protected $fillable =  [ 
                                    'post_slug',
                                    'post_type',
                                    'post_parent_id',
                                    'post_category_id',
                                    'post_title',
                                    'post_title_arabic',
                                    'post_image',
                                    'post_image_arabic',
                                    'post_priority',
                                    'post_set_as_banner',
                                    'post_created_by',
                                    'post_updated_by',                                    
                                    'post_status'
                                ];

        const CREATED_AT = 'post_created_at';

        const UPDATED_AT = 'post_updated_at';
        
        public function sluggable(){
            return [
                'post_slug' => [
                    'source' => 'removeTags'
					]
            ];
        }
		
		
		public function scopeActive($query){
			return $query->where('post_status', 1);
		}

		public function scopeInActive($query){
			return $query->where('post_status', 2);
		}
	
	
		public function getRemoveTagsAttribute() {
			return strip_tags($this->post_title);
		}
		
        public static function boot(){
            parent::boot();
        }
		
		function isActive(){
			return ($this->post_status == 1);
		}
		
        
        function getTitle(){
			return $this->getData('post_title');
		}

        function getId(){
			return $this->post_id;
		}




}