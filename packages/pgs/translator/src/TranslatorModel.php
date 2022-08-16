<?php
namespace Pgs\Translator;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Extension\BaseAppModel;
use Cviebrock\EloquentSluggable\Sluggable;
use \Venturecraft\Revisionable\RevisionableTrait;
use \App\Traits\DataTrait;	
	
class TranslatorModel extends Model
{
	protected $table = 'translator_translations';

	protected $primaryKey = 'id';
	
	// use \Waavi\Translation\Traits\Translatable;
	protected $translatableAttributes = ['text'];
	protected $fillable = ['text','locale','namespace','group','item'];
	
	function getId(){
		return $this->id;
	}
	
	/* public function locale(){
		return $this->hasOne('App\Models\Admodels\TranslatorLocaleModel','locale');
	} */
}