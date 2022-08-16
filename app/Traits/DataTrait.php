<?php
namespace App\Traits;
use App;
trait DataTrait {
	
	function getData($field){
		$data = '';
		try{
			$dataDefault = $this->$field;
			if(empty($dataDefault)){
				$dataDefault = $this->getMeta($field);
			}
			switch(App::getLocale()){
				
				case 'en':
					$data = $this->$field;
					if(empty($data)){
						$data = $this->getMeta($field);
					}
				break;
				
				case 'ar':
					
					$field = str_replace(['_ar','_en','_arabic','_english'],'',$field);
					
					$data = isset($this->{$field.'_arabic'}) ? $this->{$field.'_arabic'} : (isset($this->{$field.'_ar'}) ? $this->{$field.'_ar'} : ((isset($this->{$field})?$this->{$field}:'')));
					
					if(empty($data)){
						$data = ($this->hasMeta($field.'_arabic')) ? $this->getMeta($field.'_arabic') : (($this->hasMeta($field.'_ar')) ? $this->getMeta($field.'_ar') : '');
					}
				break;
				
			}
		}catch(\Exception $e){
	
		}
		return (empty($data)) ? $dataDefault : $data;
	}	
	
	
	function formatDate1($field,$format = 'M d Y'){
		$day = date('d',strtotime($this->$field));
		$month = date('M',strtotime($this->$field));
		$year = date('Y',strtotime($this->$field));
		return $day.' '.trans('messages.'.strtolower($month)).' '.$year;
	}
	
	function getAvatar($field){

		return (empty($this->$field)) ? asset('assets/frontend/images/user-avatar.svg/') : asset('storage/app/public/uploads/user_avatar/'.$this->$field);
	}
    
    
    function getPostImage($field,$sub=''){
		$image=(!empty($this->getData($field)))?$this->getData($field):'default_image.jpg';
        return asset('storage/app/public/post/'.((!empty($sub))?$sub.'/':$sub).$image);
		
    }
	
	function getGalImage($field,$sub=''){
		$image=(!empty($this->getData($field)))?$this->getData($field):'default_image.jpg';
        return asset('storage/app/public/uploads/gallery/'.((!empty($sub))?$sub.'/':$sub).$image);
		
    }
	
}
?>