<?php
namespace App\Traits;
use App;

trait CustomMenuTrait {
	
	/**
		* function returns Array()
		* used to render data-attributes automatically except specified here.
		* NOTE : some attributes are already hard coded like : data-slug 
	**/
	function _getAttribsToIgnore(){
		return [
			'mm_id',
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
	}
	
	
	
	/**
     * Add Generate Anchor Element with attributes
     *
     * @param mixed $attr
     * @param mixed $value
     *
     * @return object (instance)
     */
	function anchorString($dataObj ,$li,$extra = ''){
		// pre($dataObj);
		$allStr = '';
		if($this->config['primary_key'] == 'mm_id'){
			if(request()->route()->getName() == 'home' && ($dataObj['mm_is_hash_link'] == 1 )){
				$href = '#'. $dataObj['mm_slug'];
			}
			else if(request()->route()->getName() != 'home' && $dataObj['mm_is_hash_link'] == 1){
				$href = asset(\App::getLocale().'#'.$dataObj['mm_slug']);
			}
			else{
				$href = asset(\App::getLocale().'/'.$dataObj['mm_slug']);
			}
		}else{
			$href= apa('category_manager/update/'.$dataObj['category_id']);
			$allStr .= ' title="Edit Category" ';
		}
		
		// per($this->optionAnchorAttr);
		if(!empty($this->optionAnchorAttr)){
			$attrStr = ' ';
			foreach($this->optionAnchorAttr as $liAttr => $anchorAttrVal){
				if(isset($dataObj[$anchorAttrVal])){
					$anchorAttrVal = ($liAttr == 'data-href') ? $href : $dataObj[$anchorAttrVal];
				}
				$attrStr .= $liAttr.'="'.$anchorAttrVal.'" ';
			}
			$allStr.= $attrStr;
			
		}
	
		if(!empty($dataObj)){
			if($this->config['primary_key'] == 'mm_id'){
				$allStr.='aria-title="'.$this->getDataByLang($dataObj,'mm_title').'"';
				if(strpos($allStr,'class')){
					if( (request()->route()->getName() == 'home' && ($dataObj['mm_is_hash_link'] == 1 || $dataObj['mm_is_hash_link_in_home_only'] == 1))){
						$allStr = str_replace('class="','class="scroll ',$allStr);
					}
				}
			}else{
				$allStr.='aria-title="'.$this->getDataByLang($dataObj,'category_title').'"';
			}
			
			
		}

		$iconIdom = (isset($li['data-icon-class'])) ? '<i class="'.$li['data-icon-class'].'"></i>' : '';
		return "\n\t".'<a '.$allStr.' href="'.$href.'">'.$iconIdom.$li['label'].'</a>';
		
	}
	
	/**
		* Get Menu Variable data based on App language
	**/
	
	function _getDataByLang($dataObj,$key){
		
		$val = '';
		if(\App::getLocale() == 'en'){
			$val = $dataObj[$key];
		}elseif(isset($dataObj[$key.'_arabic'])){
			$val = $dataObj[$key.'_arabic'];
		}elseif(isset($dataObj[$key.'_ar'])){
			$val = $dataObj[$key.'_ar'];
		}
		return $val;
		
	}	
	
	function _getMenuTitleForAdmin($dataObj,$key){
		
		$val = $dataObj[$key];
		if(isset($dataObj[$key.'_arabic'])){
			$val .= ' | <span dir="rtl">'.$dataObj[$key.'_arabic'].'</span>';
		}elseif(isset($dataObj[$key.'_ar'])){
			$val .= ' | <span dir="rtl">'.$dataObj[$key.'_ar'].'</span>';
		}
		return $val;
		
	}
	
	/**
		* Merge All the atrtibute Strings (ul,li,a)
		* @return Array
	**/
	function _getAllAttrString($dataObj,$li,$extra,$hasChild){
		
		$allAttrStr = '';
		$submenuSpan = '';
		
		$allAttrStr.= $this->_getUlLiAttribs($dataObj);
		$allAttrStr.= $this->_getAnchorAttribs($li);
		
		
		$allAttrStr = str_replace('class="','class="'.$extra.' ',$allAttrStr);
		
		if($hasChild){
			$allAttrStr = str_replace('class="','class="dropdown smallMenu has-submenu '.$extra,$allAttrStr);
			$submenuSpan = "\n".' <span class="arrow-submenu"></span> ';
		}
		
		return [$allAttrStr,$submenuSpan];
	}
	
	/**
		* Get UL Attributes
		* @return String
	**/
	private function _getUlLiAttribs($dataObj){

		$attrStr = ' ';
		if(!empty($this->optionLiAttr)){
			
			foreach($this->optionLiAttr as $liAttr => $liAttrVal){
				if(isset($dataObj[$liAttrVal])){
					$liAttrVal = $dataObj[$liAttrVal];
				}
				$attrStr .= $liAttr.'="'.$liAttrVal.'" ';
			}			

		}
		return 	$attrStr;
	}
	
	/**
		* Get a Attributes
		* @return String
	**/
	private function _getAnchorAttribs($li){
		
		$attrStr = ' ';
		if(!empty($li)){
			$attrStr = '';
			$anchorAttrToIgnore = ['label','href'];
			foreach($li as $liAttr => $liAttrVal){
				
				if(in_array($liAttr,$anchorAttrToIgnore)){
					continue;
				}
				$attrStr .= $liAttr.'="'.$liAttrVal.'" ';
			}
		}
		return $attrStr;
	}
	
	
	
	
}
?>
