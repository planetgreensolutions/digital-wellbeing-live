<?php
namespace App\Traits\Admin;
use App;
trait FilterTrait {
	
	public static function getFilterDom(){
		
		$filters = self::$filters;
		
		foreach($filters as $key => &$filter){
			if($filter['type'] == 'select'){
				
				$filter['data'] = (!empty($filter['data']))?$filter['data']:[];
				
				$modelArr = $filter['model'];
				
				if(!empty($modelArr)){
					$modelName = isset($modelArr['src']) ? $modelArr['src'] : null;
					$modelTitleKey = isset($modelArr['title_key']) ? $modelArr['title_key'] : null;
					$postCollectionKey = isset($modelArr['post_collection']) ? $modelArr['post_collection'] : null ;
					
					if($modelName)
					{
						if($postCollectionKey)
						{
							$dataModel = $modelName::where('post_type',$postCollectionKey)->get();
						}else
						{
							$dataModel = $modelName::all();
						}
					}
					$selectArr = [];
					if(!empty($dataModel))
					{
						foreach($dataModel as $d)
						{
							$selectArr[$d->getKey()] = (!empty($d->getData($modelTitleKey)))?$d->getData($modelTitleKey):lang($modelTitleKey);
						}
						
					}
					$filter['data'] = $selectArr;
				}
			}
		}
		// pre($filters);
		
		$data['filters'] = $filters;
		return View('admin.common.filters',$data)->render();
		
	}
	
		
	function scopefilter($query,$func = null,$request = null){
		
		$filters = self::$filters;
		$request = (empty($request)) ? request() : $request;
		foreach($request->all() as $key => $value){
			if(isset($filters[$key]) && !empty($value)){
				$realKey = str_replace('filter_','',$key);
				
				switch($filters[$key]['q']){
					case 'like':
						$query->where($realKey ,$filters[$key]['q'],'%'.$value.'%');
					break;
					
					case 'datetime':
						// $query->where($realKey ,$filters[$key]['q'],'%'.$value.'%');
					break;
					
					case 'custom':
						if($func){
							return $func($query,$filters[$key],$value);
						}else{
							die('runtime function must be passed for custom query, with in the filter function' );
						}
					break;
					
					default :
						if($filters[$key]['model'] && $filters[$key]['model']['foreign']){
							$model = $filters[$key]['model']['src'];
							$modelData = $model::find($value);
							// pre($realKey);
							$query->whereHas($realKey,function($q) use($value,$modelData){
								$q->where($modelData->getKeyName(),'=',$value);
							});
						}else{
							$query->where($realKey ,'=',$value);
						}
					break;
				}
			}
		}
		
	}
	
}
?>