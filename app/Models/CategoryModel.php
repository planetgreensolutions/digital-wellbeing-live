<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Traits\PGSMetable;
use App\Traits\DataTrait;
use App\Traits\PGSMediaTrait;

class CategoryModel extends Model {

    use Sluggable;
    
	use SoftDeletes;
 use PGSMetable,DataTrait,PGSMediaTrait;

    protected $table = 'category_master';
	
	protected $primaryKey = 'category_id';

    protected $parent = 'category_parent_id';
	
	protected $dates = ['deleted_at'];
	
    // protected $with = ['parentCategory'];

    protected $fillable = [
        'category_parent_id',
        'category_priority',
        'category_title',
        'category_title_arabic',
        'category_slug',
        'category_image',
        'category_icon',
        'category_created_at',
        'category_updated_at',
        'category_created_by',
        'category_updated_by',
        'category_status'
    ];

    const CREATED_AT = 'category_created_at'; 

    const UPDATED_AT = 'category_updated_at';
    
    public function sluggable(){
        return [
            'category_slug' => [
                'source' => 'category_title'
            ]
        ];
    }

   /*  function parentCategory(){
        return $this->hasOne('App\Models\CategoryModel', 'category_parent_id');
    }
 */
    public function scopeActive($query){
        return $query->where('category_status', 1);
    }

    public function scopeInActive($query){
        return $query->where('category_status', 2);
    }
    
	public function subCategoryList(){
			return $this->hasMany('\App\Models\Admodels\PostModel','post_sub_category_id','post_id')->whereNull('deleted_at');
		}
        
   

}