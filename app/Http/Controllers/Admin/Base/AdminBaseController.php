<?php

namespace App\Http\Controllers\Admin\Base;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Validator;
use App\Models\Admodels\MenuManagerModel;
use App\Http\Controllers\Session;

use Cookie , Config, View, File, Image, Storage;

use \Twitter;
use MetzWeb\Instagram\Instagram;
use App\User;
use Carbon\Carbon as Carbon;
use App\Models\Leftmenu as Leftmenu;

class AdminBaseController extends Controller{
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
  

    protected $module;
	
    protected $data = [];
    
    protected $requestSlug;

    protected $postDateFormat = 'd/m/Y';
    
    protected $databaseDateFormat = 'Y-m-d';

    protected $buttons;
	
    protected $hasTextEditor;
	
    protected $hasPluploader;

    protected $imageDimensions;

	public function __construct(Request $request){	
		
		// pre($request->fullUrl());
        $config = \HTMLPurifier_Config::createDefault();
            
        $config->set("HTML.Allowed", "");
            
        $this->data['HTMLTextOnlyPurifier'] = new \HTMLPurifier($config);

        $this->data['currentURI'] = $request->fullUrl();

        $this->data['lang'] = 'en';

        $this->data['pageTitle'] = 'Admin';
        $routeParams = \Route::current()->parameters();
        $this->requestSlug = (!empty($routeParams['slug']))?$routeParams['slug']:false;
        
        $this->_set_page_title($this->requestSlug);
        
        $this->buttons = ['add'=>true,'edit'=>true,'delete'=>true,'status'=>true];
        $this->data['buttons'] = $this->buttons;
        $this->data['hasPluploader'] = $this->hasPluploader;
        $this->data['hasTextEditor'] = $this->hasTextEditor;
		

        $this->middleware(function ($request, $next) {
            if(\Auth::user()){
				$userID = \Auth::user()->id;
				$this->data['userObj'] =  User::findOrFail($userID);
				$this->userObj =  $this->data['userObj'];
				// pre($this->userObj );
				/* if($this->userObj->hasRole('Country Coordinator')){
					\App::setLocale('ar');
				} */
            }

            $this->data['userMessage'] = \Session::get('userMessage');
             
            $this->data['errorMessage'] = \Session::get('errorMessage');
     
            $this->data['message'] = \Session::get('message');

     
            $this->data['activationMessagee'] = \Session::get('activationMessagee');
     
            $this->data['homeMessage'] = \Session::get('homeMessage');
     
            $this->data['topMessage'] = \Session::get('topMessage');
             
            $this->data['hasTextEditor'] = false;
             
            $this->data['hasPluploader'] = false;

            $this->data['admin_settings'] = DB::table('setting')->first();

            return $next($request);
     
         });
 
		 $this->get_website_settings();
		 
		 $this->data['lang'] = \App::getLocale();
         // $this->set_multi_language(); 

    }
	
	
	
	protected function returnInvalidPermission($request){
		$responseText = '<div class="alert alert-danger">Invalid Permission</div>';
		if($request->ajax()){
			return response()->json(['status'=>false,'userMessage'=>$responseText]) ;
		}
		else{
			return Redirect(route('admin_dashboard'))->with('userMessage',$responseText) ;
		}
	}

	protected function checkPermission($action){

		$permissionName = $action.' '.ucfirst($this->module);
		return ($this->userObj->can($permissionName) || Auth::user()->is_super_admin == 1) ? true : false;
	}
	
	

	 
	  private function getLeftMenu($str,$category){
		
         
			
			if(count($category['child']) > 0){
				
				
			    $childLists = Leftmenu::parent($category['id'])->renderAsArray();
	
				$childrenLists= array();
			
				
				foreach($childLists as $children){
					
					$childrenLists = $this->getChildrenList($childrenLists,$children);
				}
							
				
				$str .= '<li class="treeview ' .$this->get_admin_menu_active_class($this->data['currentURI'], $childrenLists). '"> 
                <a href="'.$category['slug'].'">
                    <i class="fa fa-cogs"></i> <span>Manage ' .$category['name']. '</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>		
                <ul class="treeview-menu">';
		        
				 foreach($category['child'] as $cat){
				 if(count($cat['child'])>0){
					 $str = $this->getLeftMenu($str,$cat);
					 
					 
				 }else{	
                				 
				 $str .= '<li class="treeview "' .$this->get_admin_menu_active_class($this->data['currentURI'],$cat['name']).'><a href="'.asset(Config::get('app.admin_prefix').'/'.$cat['slug']).'"><i class="fa fa-child"></i> <span>Manage '.$cat['name'].'</span></a></li>';
				 }
				 }
				 
			
				$str.='</ul>	
         </li> ';
		
		}else{
			$str.= '<li class="treeview '. $this->get_admin_menu_active_class($this->data['currentURI'], array($category['name'])).'"><a href="'.asset(Config::get('app.admin_prefix').'/'.$category['slug']).'"><i class="fa fa-image"></i> <span>Manage '.$category['name'].'</span></a></li>';
		}
		
	

		return $str;
	}
	
	private function getChildrenList($childrenLists,$children){
		$childrenLists[] = $children['name'];
		
		if(count($children['child']) > 0){
			foreach($children['child'] as $newChild){
				 
			    $childrenLists = $this->getChildrenList($childrenLists,$newChild);
			}
		}
		
		return $childrenLists;
	}
	
	 
	 
	protected function get_admin_menu_active_class($currentURI, $slugArr) {

    $className = '';
    $listArr = $slugArr;
    if (!is_array($listArr)) {
        $listArr = array();
    }
    $URLParts = explode("/", $currentURI);
    if (!empty($URLParts)) {
        foreach ($URLParts as $Uparts) {
            if (in_array($Uparts, $listArr)) {
                $className = 'active';
            }
        }
    }

    if (in_array('seo', $URLParts)) {
        return null;
    }
  
    return $className;
	}

    
	protected function _get_child_post_data($request,$parentId){
        $postArr = [];
        
		if(empty($request->postChild) || !isset($request->postChild)) return false;
        
		
		
		foreach($request->postChild['title'] as $key=>$postData){
			if(!empty($request->postChild['title'][$key])){
				$temp = [];
				$temp['post']['post_title'] = $request->postChild['title'][$key];
				$temp['post']['post_title_arabic'] = $request->postChild['title_arabic'][$key];
				$temp['post']['post_type'] = $request->post['type'].'_child';
				$temp['post']['post_parent_id'] = $parentId;
				$temp['post']['post_created_by'] = auth()->user()->id;
				$temp['post']['post_updated_by'] = auth()->user()->id;
				$temp['post']['post_status'] = 1;
				
				$temp['postMeta'] = $this->_get_child_post_meta_data($request,$key);
				$postArr[] = $temp;
			}
		}
        
        return $postArr;
    }

    private function _get_child_post_meta_data($request,$arrIndex){
		
        $postMetaArr = [];
        $postMetaArrResult = [];
		$arrayKeys = [];
        if(empty($request->postChild['meta']) || !isset($request->postChild['meta'])) return false;
		
		
		// pre($array_keys);
		
		foreach($request->postChild['meta'] as $key=>$postData){
			
			if($key == 'date'){
			
				
				foreach($postData as $key1=>&$val1){
					$val1= Carbon::parse($val1)->format($this->postDateFormat);
					$postData[$key1] = $this->_getCarbonObject($val1, $this->postDateFormat);
				}
			
			}
			
			$postMetaArr[] = $postData; //laravel helper
		}
		
		// $metaArr = array_collapse($postMetaArr);
		
		$postMetaArr = array_collapse($postMetaArr);
		
		$array_keys = array_keys($postMetaArr);
		
		// pre($array_keys);
		
         foreach($array_keys as $metaKey){
			 // pre($postMetaArr[$metaKey][$key]);
			if(!empty($postMetaArr[$metaKey][$arrIndex])){
				$postMetaArrResult[$arrIndex][$metaKey] = $postMetaArr[$metaKey][$arrIndex]; 
			}
			
		}
		
		
       /*  foreach($request->postChild['meta'] as $key=>$postData){
           
            if($key == 'date'){
                    foreach($postData as $key1=>&$val1){
					
				          
						 $val1= Carbon::parse($val1)->format($this->postDateFormat);
						 $postData[$key1] = $this->_getCarbonObject($val1, $this->postDateFormat);
						
                       
                    }
            }
            $postMetaArr[] = $postData; //laravel helper
        } */
		
		
		
        return array_collapse($postMetaArrResult);
    }
	
    
    protected function _get_post_data($request){
        $postArr = [];
        if(empty($request->post) || !isset($request->post)) return false;
        foreach($request->post as $key=>$postData){
            $postArr['post_'.$key] = $postData;
        }
        $postArr['post_created_by'] = auth()->user()->id;
        $postArr['post_updated_by'] = auth()->user()->id;
        return $postArr;
    }
	
	
	
	
	protected function _get_post_meta_data($request){
      
        $postMetaArr = [];
        if(empty($request->meta) || !isset($request->meta)) return false;
		
        foreach($request->meta as $key=>$postData){
           
            if($key == 'date'){
                    foreach($postData as $key1=>&$val1){
					
				          
						 $val1= Carbon::parse($val1)->format($this->postDateFormat);
						 $postData[$key1] = $this->_getCarbonObject($val1, $this->postDateFormat);
						
                       
                    }
            }
            $postMetaArr[] = $postData; //laravel helper
        }
		
		
		
        return array_collapse($postMetaArr);
    }


    private function _getCarbonObject($dateStr,$sourceFormat){
		
		
        $dateObj = Carbon::createFromFormat($sourceFormat, $dateStr);
	
        if(!$dateObj) return false;
        return $dateObj;
    }


    private function _convertDate($dateStr,$sourceFormat,$targetFormat){
        $dateObj = DateTime::createFromFormat($sourceFormat, $dateStr);
        if(!$dateObj) return false;
        return $dateObj->format($targetFormat);
    }

    private function _set_page_title($slug){
        
        $pageDetails = MenuManagerModel::where('mm_slug','=',$slug)->first();

        if(!empty($pageDetails)){
            $this->data['pageTitle'] = $pageDetails->mm_title;
        }else{             
            $this->data['pageTitle'] =  ucwords(str_replace("-"," ",$slug));
        }

        
    }

    
    protected function get_days_from_interval($fromDate, $toDate, $resultFormat ='Y-m-d'){
        try{
            $intervalDays = new \DatePeriod(
                 new \DateTime($fromDate),
                 new \DateInterval('P1D'),
                 new \DateTime($toDate)
            );
            
            $res = array();
            foreach($intervalDays as $day){
                $res[] =  $day->format($resultFormat);
            }
        }catch(\Exception $ex){
            return false;
        }
        return $res;
    }

    protected function custom_message($validator,$type){
       // pre($validator);
       $userMessage = $validator;
       if(is_object($validator)){
            $userMessage = '<ol>';
            $messages = $validator->messages();
            
            foreach($messages->all() as $message){
                $userMessage.= '<li>'.$message.'</li>';
            }		
            $userMessage .= '</ol>';
            
            if($type=='error'){
                $message = '<div class="alert alert-danger alert-dismissable">'.
                            '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><b>'.
                            '<div class="user-message-header"><i class="fa fa-ban"></i> You have '.$messages->count().' errors.</div>'.
                            $userMessage.
                        '</b></div>';
            }
       }else{
            if($type=='success'){
                $message = '<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i>
                   <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><b>'.$userMessage.'</b></div>';
            }elseif($type=='error'){
                $message = '<div class="alert alert-danger alert-dismissable">'.
                            '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><b>'.
                            $userMessage.
                        '</b></div>';
            }
       }
        return $message;
    }


    protected function store_file($controlName,$path){
        $file = request()->file($controlName);
        if(!$file) return false;
        $fileName = $file->hashName();
        $fileNameWithPath = $file->store($path);
        return array($fileName, $fileNameWithPath);
    }

    
	
	 
	 
	 
	  protected function resize_and_crop_image($controlName,$destinationPath,$dimensions=array(),$oldFileName=''){
        
		if(empty($destinationPath)) return false;
		if(empty($controlName)) return false;
		
		if (!request()->hasFile($controlName)) return false; // check whether file is uploaded
	
		if(!request()->file($controlName)->isValid()) return false; // chek whether file is valid`

		$destinationPath = 'storage/app/'.$destinationPath;
		
		 $file = Input::file($controlName);

		$extension = $file->getClientOriginalExtension();
		$filename = md5(microtime()).'.'.$extension;

		$imageUpload =  Input::file($controlName)->move($destinationPath, $filename);

		$sourceImage = $destinationPath.DIRECTORY_SEPARATOR.$filename;
		if(!empty($dimensions)){
			foreach($dimensions as $dim){
				
				if (!File::isDirectory($destinationPath.'/'.$dim['folder']."/")){
					File::makeDirectory($destinationPath.'/'.$dim['folder']);
				}

				Image::make($sourceImage)
				->fit($dim['width'],$dim['height'])
				->save($destinationPath.'/'.$dim['folder'].'/'.$filename)
				->destroy();
			}
		}
			if(!empty($oldFileName) && File::exists($destinationPath.'/'.$oldFileName) ){				
				File::delete($destinationPath.'/'.$oldFileName);
				if(!empty($dimensions)){
					foreach($dimensions as $dim){
						File::delete($destinationPath.'/'.$dim['folder'].'/'.$oldFileName);
					}
				}
			}



		// echo $destinationPath.'/'.$oldFileName."DD";exit();
		return $filename;

    }
	
	
    
    protected function resize_image($fileName,$filePath,$dimensions=array(),$crop=true,$oldFileName=''){ 

		if(empty($fileName)) return false;
		if(empty($filePath)) return false;

        try{
            $sourcePath = './storage/app/'.$filePath.DIRECTORY_SEPARATOR;
            $sourceImage = $sourcePath.$fileName;
            if(!empty($dimensions)){
                foreach($dimensions as $key=>$dim){
                    if (!File::isDirectory($sourcePath.'/'.$key."/")){
                        File::makeDirectory($sourcePath.'/'.$key,0777,true);
                    }
                    if($crop){
                            Image::make($sourceImage)
                            ->fit($dim['width'],$dim['height'])
                            ->save($sourcePath.'/'.$key.'/'.$fileName)
                            ->destroy();
                    }else{
                        Image::make($sourceImage)
                                ->resize($dim['width'], $dim['height'], function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->save($sourcePath.'/'.$key.'/'.$fileName)
                        ->destroy();
                    }
                }
            }

            if(!empty($oldFileName) && File::exists($sourcePath.'/'.$oldFileName) ){
                File::delete($sourcePath.'/'.$oldFileName);
                if(!empty($dimensions)){
                    foreach($dimensions as $key=>$dim){
                        File::delete($sourcePath.'/'.$key.'/'.$oldFileName);
                    }
                }
            }
        }catch(Exception $ex){
           return false;
        }
        
		return true;
    }
    
    protected function deleteFile($fileName=null, $request){
        $postBasePath = 'storage/app/public/post/';
        if(!empty($fileName) && File::exists($postBasePath.$fileName) ){
            
            DB::table('meta')->where('value','=',$fileName)->delete();
            
            if (File::exists($postBasePath . $fileName)) {
                File::delete($postBasePath . $fileName);
            }
            if (File::exists('storage/app/post/uploads/recommended/' . $fileName)) {
                File::delete('storage/app/post/uploads/recommended/' . $fileName);
            }
            if (File::exists('storage/app/post/uploads/large/' . $fileName)) {
                File::delete('storage/app/post/uploads/large/' . $fileName);
            }
            if (File::exists('storage/app/post/uploads/small/' . $fileName)) {
                File::delete('storage/app/post/uploads/small/' . $fileName);
            }

            return \Response::json(array('status'=>true,'message'=>'File Deleted.','msgClass'=>"sticky-success"));
        }else{
            return \Response::json(array('status'=>false,'message'=>'No such file found.','msgClass'=>"sticky-important"));
        }
        
        return \Response::json(array('status'=>false,'message'=>'Invalid Request','msgClass'=>"sticky-important"));
    }
    
    protected function downloadFile($fileName=null, $request){
        if(!empty($fileName) && File::exists($postBasePath.$fileName) ){
            $fileDetails = DB::table('post_details_text')->where('pdt_value','=',$fileName)->first();
            return response()->download(storage_path('app/public/post/'.$fileName));
        }else{
            return \Response::json(array('status'=>false,'message'=>'No such file found.','msgClass'=>"sticky-important"));
        }
        
        return \Response::json(array('status'=>false,'message'=>'Invalid Request','msgClass'=>"sticky-important"));
    }
    protected function buildTree($elements, $parentId = 0) {
      $branch = array();

      foreach ($elements as $element) {
    
          if ($element->page_parent_id == $parentId) {
              $children = $this->buildTree($elements, $element->page_id);

              if ($children) {
                  $element->childrens = $children;
              }

              $branch[] = $element;
          }
      }

      return $branch;
  }
  protected function get_website_settings(){
		$this->data['admin_settings'] = $this->data['websiteSettings'] =  \DB::table('setting')->first();
		$this->data['pageTitle'] = '';
	}

  public function set_multi_language(){
  	$this->middleware(function ($request, $next) {
  		$lang = \Session::get('lang');

  		$this->data['lang'] =$lang = session()->has( 'lang' ) ? session()->get( 'lang' ) : 'en';


  		if(empty($lang)){
  			$lang= $this->data['websiteSettings']->default_lang;
  			Session::put('lang', $lang);
  			Session::save();
  		}
  		switch ($lang) {
  			case 'en':
  				setlocale(LC_ALL, 'en_GB.UTF8');
  			break;
  			case 'ar':
  				setlocale(LC_ALL, 'ar_AE.utf8');
  			break;
  		}
  		\App::setLocale($lang);
  		return $next($request);
  	});
  }
  
  public function _GetCategoryNestableConfig(){
		return [
			'parent'=> 'category_parent_id',
			'primary_key' => 'category_id',
			'generate_url'   => true,
			'childNode' => 'child',
			'body' => [
				'category_id',
				'category_title',
				'category_slug',
			],
			'html' => [
				'label' => 'category_title',
				'label_arabic' => 'category_title_arabic',
				'href'  => 'category_slug'
			],
			'dropdown' => [
				'prefix' => '-',
				'label' => 'category_title',
				'value' => 'category_id',
				'attr' =>[
					'class'=>'form-control'
				]
			]
			];
	}
}