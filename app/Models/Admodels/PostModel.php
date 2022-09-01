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
use App\Traits\PGSMediaTrait;
use Nestable\NestableTrait;
use App\Models\Admodels\PostTagModel;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use App;


use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class PostModel extends Model implements AuditableContract
{
        
        use Sluggable, \OwenIt\Auditing\Auditable;
        use RevisionableTrait,NestableTrait;
        use \Conner\Tagging\Taggable;
        use PGSMetable,DataTrait,PGSMediaTrait , SoftDeletes;
        
        /**
         * The database table used by the model.
         *
         * @var string
         */
        // protected $parent = 'post_category_id';
        
        
        protected $table = 'posts';

        protected $primaryKey = 'post_id';
        
        protected $with = ['meta','parentPost','media','childPosts','postTags','category','subCategory'];
        
        protected $revisionEnabled = true;
        protected $revisionCreationsEnabled = true;
        protected $historyLimit = 50;
       // protected $revisionCleanup = true; //Remove old revisions (works only when used with $historyLimit)
      

        protected $fillable =  [
                                    'post_slug',
                                    'post_type',
                                    'post_parent_id',
                                    'post_category_id',
                                    'post_sub_category_id',
                                    'post_title',
                                    'post_title_arabic',
                                    'post_image',
                                    'post_image_arabic',
                                    'post_priority',
                                    'post_set_as_banner',
                                    'post_created_by',
                                    'post_updated_by',
                                    'post_status',
                                    'deleted_at'
                                ];

        const CREATED_AT = 'post_created_at';

        const UPDATED_AT = 'post_updated_at';
        
        public function sluggable()
        {
            return [
                'post_slug' => [
                    'source' => 'removeTags'
                    ]
            ];
        }
        
        
        public function scopeActive($query)
        {
            return $query->where('post_status', 1);
        }

        public function scopeInActive($query)
        {
            return $query->where('post_status', 2);
        }
    
    
        public function getRemoveTagsAttribute()
        {
            return strip_tags($this->post_title);
        }
        
        public static function boot()
        {
            parent::boot();
        }
        
        function isActive()
        {
            return ($this->post_status == 1);
        }
        
        public function postTags()
        {
            return $this->hasOne('\App\Models\Admodels\PostTagModel', 'taggable_id', 'post_id');
        }
        
        public function parentPost()
        {
            return $this->hasOne('\App\Models\Admodels\PostModel', 'post_id', 'post_parent_id');
        }
        
        public function bannerPost()
        {
            return $this->hasOne('\App\Models\Admodels\PostModel', 'post_id', 'post_parent_id');
        }
        
        public function category()
        {
            return $this->belongsTo('\App\Models\CategoryModel', 'post_category_id', 'category_id')->orderBy('category_priority', 'ASC')->whereNull('deleted_at');
        }
        
        public function subCategory()
        {
            //return $this->belongsTo('\App\Models\CategoryModel','post_sub_category_id','category_id')->orderBy('category_priority','ASC');
            return $this->hasOne('\App\Models\CategoryModel', 'category_id', 'post_sub_category_id')->orderBy('category_priority', 'ASC')->whereNull('deleted_at');
        }
        
        public function childPosts()
        {
            return $this->hasMany('\App\Models\Admodels\ChildPostModel', 'post_parent_id', 'post_id')->whereNull('deleted_at');
        }
        
        
        public function imageGallery()
        {
        }
        public function videoGallery()
        {
            $lang=(App::getLocale()=="en")?'ar':'en';
            
            $tmp = $this->hasMany('\App\Models\Admodels\PostMediaModel', 'pm_post_id', 'post_id')
            ->whereNotNull('pm_post_id')
            ->where('pm_cat', '=', 'video');
            if (!empty(\Auth::user()) && \Auth::user()->isAdmin()) {
            } else {
                $tmp = $tmp->where(function ($q) use ($lang) {
                    $q->where('pm_lang', '!=', $lang);
                    $q->orWhereNull('pm_lang');
                });
            }
            return  $tmp ->where('pm_status', '=', 1)
            ->orderBy('pm_priority', 'ASC');
        }
        
        public function media()
        {
            
            $lang=(App::getLocale()=="en")?'ar':'en';
            
            $tmp = $this->hasMany('\App\Models\Admodels\PostMediaModel', 'pm_post_id', 'post_id')->whereIn('pm_cat', ['gallery_file','video'])->orderBy('pm_priority','asc');
            
            if (!empty(\Auth::user()) && \Auth::user()->isAdmin()) {
            } else {
                $tmp = $tmp->where(function ($q) use ($lang) {
                    $q->where('pm_lang', '!=', $lang);
                    $q->orWhereNull('pm_lang');
                });
            }
            return  $tmp->where('pm_status', '=', 1)
                    ->orderBy('pm_priority', 'ASC');
        }

        function getTitle()
        {
            return $this->getData('post_title');
        }

        function getId()
        {
            return $this->post_id;
        }

        function getCouncilRoleEN()
        {
            return PostModel::where('post_type', 'council-roles')
                ->where('post_id', $this->getData('council_role'))
                ->pluck('post_title')
                ->first();
        }

        function getCouncilRoleAR()
        {
            return PostModel::where('post_type', 'council-roles')
                ->where('post_id', $this->getData('council_role'))
                ->pluck('post_title_arabic')
                ->first();
        }

        public function getEsafePost()
        {
            return PostModel::select('post_slug')->where('post_type', 'be_an_esafe_kid_article')
                ->whereMeta('esafe_category_id', $this->getData('post_id'))
                ->pluck('post_slug')
                ->first();
        }

        function geteSafeCategory()
        {
            return PostModel::where('post_type', 'be_an_esafe_kid')
                ->where('post_id', $this->getData('esafe_category_id'))
                ->first();
        }

        public function articleTags()
        {
            return PostTagModel::select('tag_name')
                ->where('taggable_id', $this->getData('post_id'))
                ->groupBy('tag_name')
                ->pluck('tag_name')
                ->toArray();
        }
}
