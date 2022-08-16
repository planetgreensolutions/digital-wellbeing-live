<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Base\AdminBaseController;
use Validator, Input, Redirect,Auth,Config,DB;
use Illuminate\Support\Facades\Gate;
use App\User as User;
use Illuminate\Http\Request;
use App\Models\Admodels\MenuManagerModel;
use File;


class MenuController extends AdminBaseController {

  private $pageSlug;
  
  public $tree = array();

  private $flatTree = [];
  
	public function __construct(Request $request){

		 parent::__construct($request);

	}
	
	public function index(Request $request){
		
        $menuManager = new MenuManagerModel();
		
		// pre($menuManager::getFrontendMenuUL($request));
		$this->data['menuHTML'] = $menuManager::firstOlAttr('class','dd-list')
                    ->orderBy('mm_priority','asc')
                    ->renderAsNestableDraggable();
       
		return view('admin.menu_manager.list',$this->data);
	}

	public function create(Request $request){
		
		
		if( $request->input('createbtnsubmit') && $request->isMethod('post') ){
			
			$messages = [
				'mm_title.required'=> 'Menu Title is required',
				'mm_priority.required'=> 'Menu Priority is required',
				'mm_icon_file.mimes'=> 'Invalid Icon File uploaded. Allowed types are (svg,png)',
			];
			
			$rules = [
				'mm_title' => 'required',
				'mm_priority' => 'required',
			];
			
			if(!empty($request->file('mm_icon_file'))){
				$rules['mm_icon_file'] = 'mimes:png,svg'; 
			}
			$this->validate($request,$rules,$messages );

			$arr = array(
				'mm_parent_id' =>$request->input('categories'),
				'mm_title' =>$request->input('mm_title'),
				'mm_title_arabic' =>$request->input('mm_title_arabic'),
				'mm_large_title' =>$request->input('mm_large_title'),
				'mm_large_title_arabic' =>$request->input('mm_large_title_arabic'),
				'mm_priority' =>$request->input('mm_priority'),
				'mm_icon_class' =>$request->input('mm_icon_class'),
				'mm_created_by'=>Auth::user()->id,
				'mm_updated_by'=>Auth::user()->id,
				'mm_status'=>$request->input('mm_status'),
				'mm_show_in_main_menu'=>2,
				'mm_show_in_footer_menu'=>2,
				'mm_show_in_mobile_menu'=>2,
				'mm_is_hash_link'=>2,
				'mm_is_hash_link_in_home_only'=>2,
				'mm_top_menu'=>2
			);
			
			if ($request->input('mm_show_in_main_menu') == 1) {
					$arr['mm_show_in_main_menu'] = 1;
			}
			
			if ($request->input('mm_show_in_footer_menu') == 1) {
					$arr['mm_show_in_footer_menu'] = 1;
			}
			
			if ($request->input('mm_show_in_mobile_menu') == 1) {
					$arr['mm_show_in_mobile_menu'] = 1;
			}
			
			if ($request->input('mm_is_hash_link') == 1) {
					$arr['mm_is_hash_link'] = 1;
			}
			
			if ($request->input('mm_is_hash_link_in_home_only') == 1) {
					$arr['mm_is_hash_link_in_home_only'] = 1;
			}
			
			if ($request->input('mm_top_menu') == 1) {
					$arr['mm_top_menu'] = 1;
			}
			
			if(!empty($request->file('mm_icon_file'))){
				$arrFileDetails = $this->store_file('mm_icon_file','public/uploads/menu');
				$arr['mm_icon_file'] = isset($arrFileDetails[0]) ? $arrFileDetails[0] : '';
			}

			// pre($arr);
			$newMenuID = MenuManagerModel::create($arr);
			$message = '<div class="alert alert-success">Menu saved successfully.</div>';
			return Redirect(route('create_menu'))->with('userMessage',$message);
			}
           

		$this->data['menuList'] = MenuManagerModel::attr(['name' => 'categories', 'class'=>'form-control'])
                                    ->selected('')
                                    ->renderAsDropdown();
									
									
									
							
									
		return view('admin.menu_manager.add',$this->data);
	}

	public function update($editId, Request $request){

  		
		if(empty($editId)) {  return redirect()->to( ap('menu_manager') );  }
	
		$this->data['menuDetails'] = MenuManagerModel::where('mm_id','=',$editId)->first();

		if(empty($this->data['menuDetails'])){
			$this->data['messages']	='Invalid menu request';
			return redirect()->to( ap('menu_manager') );
		}
		
        
		if($request->input('updatebtnsubmit')){
			
			$messages = [
					'mm_title.required'=> 'Menu Title is required',
					'mm_priority.required'=> 'Menu Priority is required',
					'mm_icon_file.mimes'=> 'Invalid Icon File uploaded. Allowed types are (svg,png)',
				];
				
				$rules = [
					'mm_title' => 'required',
					'mm_priority' => 'required',
				];
				
				if(!empty($request->file('mm_icon_file'))){
					$rules['mm_icon_file'] = 'mimes:png,svg'; 
				}
			
			$this->validate($request,$rules,$messages );

			$arr = array(
				'mm_parent_id' =>$request->input('categories'),
				'mm_title' =>$request->input('mm_title'),
				'mm_title_arabic' =>$request->input('mm_title_arabic'),
				'mm_large_title' =>$request->input('mm_large_title'),
				'mm_icon_class' =>$request->input('mm_icon_class'),
				'mm_large_title_arabic' =>$request->input('mm_large_title_arabic'),
				'mm_priority' =>$request->input('mm_priority'),
				'mm_created_by'=>Auth::user()->id,
				'mm_updated_by'=>Auth::user()->id,
				'mm_status'=>$request->input('mm_status'),
				'mm_show_in_main_menu'=>2,
				'mm_show_in_footer_menu'=>2,
				'mm_show_in_mobile_menu'=>2,
				'mm_is_hash_link'=>2,
				'mm_is_hash_link_in_home_only'=>2,
				'mm_top_menu'=>2
			);
			
            if ($request->input('mm_show_in_main_menu') == 1) {
                    $arr['mm_show_in_main_menu'] = 1;
            }
            
            if ($request->input('mm_show_in_footer_menu') == 1) {
                    $arr['mm_show_in_footer_menu'] = 1;
            }
            
            if ($request->input('mm_show_in_mobile_menu') == 1) {
                    $arr['mm_show_in_mobile_menu'] = 1;
            }
            
            if ($request->input('mm_is_hash_link') == 1) {
                    $arr['mm_is_hash_link'] = 1;
            }
            
            if ($request->input('mm_is_hash_link_in_home_only') == 1) {
                    $arr['mm_is_hash_link_in_home_only'] = 1;
            }
			if ($request->input('mm_top_menu') == 1) {
					$arr['mm_top_menu'] = 1;
			}
			if(!empty($request->file('mm_icon_file'))){
				$arrFileDetails = $this->store_file('mm_icon_file','public/uploads/menu');
				$arr['mm_icon_file'] = isset($arrFileDetails[0]) ? $arrFileDetails[0] : '';
			}
                
			$menuObj = MenuManagerModel::where('mm_id','=',$editId)->first();
			$menuObj->update($arr);
			$message = '<div class="alert alert-success">Menu saved successfully.</div>';
			return Redirect(route('edit_menu',$editId))->with('userMessage',$message);
		}
        

		$this->data['menuDetails'] = MenuManagerModel::where('mm_id','=',$editId)->first();

	    if(empty($this->data['menuDetails'])){
			 return redirect()->to( ap('menu_manager') )->with('error','Menu not found');
	    }
		
		if(!empty($request->input('redirect'))){
			return redirect()->to( ap( $request->input('redirect') ) );
		}
		
		$this->data['menuList'] = MenuManagerModel::attr(['name' => 'categories', 'class'=>'form-control'])
                                    ->selected('')
                                    ->renderAsDropdown();
		
		return view('admin.menu_manager.edit',$this->data);
	}

	public function changestatus($menuID){
        
		 $menuDetails = MenuManagerModel::where('mm_id', '=',$menuID)->first();
         
         if(empty($menuDetails)){
			 return redirect()->to( ap('menu_manager') )->with('error','Menu not found');
	     }
        
		 $currentStatus = ($menuDetails->mm_status==2)?1:2;
         
		 $currentStatusdatas = array("mm_status"=>$currentStatus);
         
		 $menuObj = MenuManagerModel::where('mm_id', '=',$menuID)->first();
		 $menuObj->update($currentStatusdatas);
         
		 return redirect()->to( ap('menu_manager') );
	}

	public function delete($deleteID){
		
        if(empty($deleteID)) { return redirect()->to(apa('menu_manager')); }
		
        $details = MenuManagerModel::where('mm_id', '=',$deleteID)->first();
		
        if(empty($details)){
			 return redirect()->to(Config::get('app.admin_prefix').'/pages');
		}
		
        $childPages =  MenuManagerModel::where('mm_parent_id', '=',$deleteID)->first();
		
        if($childPages && $childPages->count() > 0){
				$menuObj = MenuManagerModel::where('mm_parent_id', '=',$deleteID)->first();
				$menuObj->update(array('mm_parent_id'=>$details->mm_parent_id));
		}
        
		$menuObj = MenuManagerModel::where('mm_id', '=',$deleteID)->first();
		$menuObj->delete();
		
		$message = '<div class="alert alert-success">Deleted successfully</div>';
        return redirect()->to(apa('menu_manager'))->with('userMessage',$message ); 
	} 
	 
	 
    private function flatten_array($parent = '',  &$array) {
         
        foreach ($array as $key => $item) {
			$menuId = $item['id'];
            if(!empty($item['children'])){
				$this->flatTree[$parent][] = $item['id'];
                $this->flatten_array($item['id'],$item['children']); 
            }else{
                $this->flatTree[$parent][] = $item['id'];
            }
        }
        
        return $this->flatTree; 
        
    }
    public function sort_menu(Request $request){
        
       
        
        try{
			if($request->input('menu')){
				$menuList = $request->input('menu');
				$menuByParent = $this->flatten_array('', $menuList);
				if(!empty($menuByParent)){
					foreach($menuByParent as $parent => $menu){
						$parentToUpdate = ($parent) ? $parent : null;
						DB::table('menu_manager')->whereIn('mm_id',$menu)->update(['mm_parent_id'=>$parentToUpdate]);
					}
					
					foreach($menuList as $key => $menuItem){
						DB::table('menu_manager')->whereIn('mm_id',$menuItem)->update(['mm_priority'=>$key]);
					}
					
				}
				
			}
  
			return response()->json(['status'=>true,'Menu saved']);
        }catch(Exception $e){
            return response()->json(['status'=>false,'Error']);
        }
    }
}
