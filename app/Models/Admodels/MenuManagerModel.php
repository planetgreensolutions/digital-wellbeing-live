<?php
namespace App\Models\Admodels;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Extension\BaseAppModel;
use Cviebrock\EloquentSluggable\Sluggable;

use Nestable\NestableTrait;
use App\Traits\DataTrait;
use App\Traits\CustomMenuTrait;
use App\Providers\MenuServiceProvider;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class MenuManagerModel extends Model implements AuditableContract {
		
		use \OwenIt\Auditing\Auditable;
		
		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
        use Sluggable,CustomMenuTrait;
        use NestableTrait,DataTrait;
        
        protected $parent = 'mm_parent_id';
        
		protected $table = 'menu_manager';
        
		protected  static $appLang;
        
        protected $primaryKey = 'mm_id';    

        

		protected $fillable =  [ 
                                    'mm_parent_id',
                                    'mm_title',
                                    'mm_title_arabic',
                                    'mm_icon_class',
                                    'mm_icon_file',
                                    'mm_large_title',
                                    'mm_large_title_arabic', 
                                    'mm_show_in_main_menu',
                                    'mm_show_in_footer_menu',
                                    'mm_show_in_mobile_menu',
                                    'mm_top_menu',
                                    'mm_is_hash_link',
                                    'mm_is_hash_link_in_home_only',
                                    'mm_priority',
                                    'mm_status',
                                    'mm_created_by',
                                    'mm_updated_by',
                                ];

        const CREATED_AT = 'mm_created_at';

        const UPDATED_AT = 'mm_updated_at';
        
        public function sluggable(){
            return [
                'mm_slug' => [
                    'source' => 'mm_title'
                ]
            ];
        }
		
		
		public static function getFrontendTopMenuUL($request, $attributes){
			 $current=$request->segments();
			if(!empty($current[1])){
			   $slug=$current[1];	
			}else{
				$slug="home";
			}
			self::$appLang = \App::getLocale();
			
			$data = self::where('mm_top_menu',1)
						->where('mm_show_in_main_menu',1)
						->where('mm_status',1)
						->orderBy('mm_priority','asc')

						->get();
						
			$nestableConfig = \Config::get('nestable');
			
			$temp = MenuServiceProvider::firstUlAttr('class', '');
			
			if($attributes){
				$temp = 	$temp->ulAttr('class', 'dropdown-menu')
						->liAttr([
							'class'=>'nav-item',
							'id'=>'mm_id',
							'data-id'=>'mm_id',
						])
						->anchorAttr([
							'class'=>'nav-link',
							'data-href'=>'mm_slug',
							'data-slug'=>'mm_slug'
						])
						->active($slug,'active');
						
			}else{
				$temp = $temp->anchorAttr([
							'class'=>'link_',
							'data-href'=>'mm_slug',
							'data-slug'=>'mm_slug'
						])
						->liAttr([
							'class'=>'nav-item',
							'id'=>'mm_id',
							'data-id'=>'mm_id',
						])
						
						->active($slug,'active');
			}
			$temp = $temp->make($data, $nestableConfig);
			return $temp->renderAsHtml();
			
		}
		public static function getFrontendMenuUL($request){
			 $current=$request->segments();
			if(!empty($current[1])){
			   $slug=$current[1];	
			}else{
				$slug="home";
			}
			
			self::$appLang = \App::getLocale();
			
			$data = self::where('mm_top_menu',2)
						->where('mm_show_in_main_menu',1)
						->where('mm_status',1)
						->orderBy('mm_priority','asc')
						->get();
						
			$nestableConfig = \Config::get('nestable');
			
			$temp = MenuServiceProvider::firstUlAttr('class', 'navbar-nav ')
						->ulAttr('class', 'dropdown-menu')
						->liAttr([
							'class'=>'nav-item',
							'id'=>'mm_id',
							'data-id'=>'mm_id',
						])
						->anchorAttr([
							'class'=>'nav-link',
							'data-href'=>'mm_slug',
							'data-slug'=>'mm_slug'
						])
						->active($slug,'active')
						->make($data, $nestableConfig);
			
			return $temp->renderAsHtml();
			
		}
        public static function getFrontendMenuMobile($request){
			 $current=$request->segments();
			if(!empty($current[1])){
			   $slug=$current[1];	
			}else{
				$slug="home";
			}
			
			self::$appLang = \App::getLocale();
			
			$data = self::where('mm_show_in_main_menu',1)
						->where('mm_status',1)
						->orderBy('mm_top_menu','DESC')
						->orderBy('mm_priority','asc')
						->get();
						
			$nestableConfig = \Config::get('nestable');
			
			$temp = MenuServiceProvider::firstUlAttr('class', 'navbar-nav ')
						->ulAttr('class', 'dropdown-menu')
						->liAttr([
							'class'=>'nav-item',
							'id'=>'mm_id',
							'data-id'=>'mm_id',
						])
						->anchorAttr([
							'class'=>'nav-link',
							'data-href'=>'mm_slug',
							'data-slug'=>'mm_slug'
						])
						->active($slug,'active')
						->make($data, $nestableConfig);
			
			return $temp->renderAsHtml();
			
		}
}