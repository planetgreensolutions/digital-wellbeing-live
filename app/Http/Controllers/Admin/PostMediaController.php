<?php

namespace App\Http\Controllers\Admin;
ini_set('max_execution_time', 300);

use Validator, Input, Redirect,Auth,Config,DB;
use App\User as User;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Storage;
use App\Models\Admodels\PostMediaModel;
use App\Http\Controllers\Admin\Base\AdminBaseController;


class PostMediaController extends AdminBaseController {

	private $pageSlug;
	public $tree = array();
	private $uploadPath = 'public/post';
	
	protected $imageDimesions = [];
	
	public function __construct(Request $request){
		parent::__construct($request);
		$this->imageDimesions = \Config::get('pgsimagedimensions');
	}
	

	public function index(){
		
		$this->data['fileList'] = PostMediaModel::where('pm_owner_id','=',Auth::user()->id)
								  ->paginate(5);
		// pre($this->data['fileList']);
	}

	public function create(Request $request){
		//dd($request->all());
		if($request->hasFile('file')){
			// pre('asd');
			$file = $this->store_file('file',$this->uploadPath);
			// pre($file);
			$data = null;
			if(!empty($file)){
				
				
				$nameOnly = basename($request->file('file')->getClientOriginalName(), '.'.$request->file('file')->getClientOriginalExtension());
				$extension = $request->file('file')->getClientOriginalExtension();
				$size = $request->file('file')->getClientSize();
				$mimeType = $request->file('file')->getClientMimeType();
				$mediaType = 'unknown';
				
				
				switch($extension){
					case 'jpg':
					case 'png':
					case 'svg':
					case 'gif':
					case 'bmp':
						$mediaType = 'image';
					break;
					default:
						$mediaType = 'file';
					break;
					
				}
				$data = [
					'pm_name' => $nameOnly,
					'pm_orig_name' => $file[1],
					'pm_file_hash' => $file[0],
					'pm_media_type'=>$mediaType,
					'pm_owner_id' => (Auth::user())?Auth::user()->id:null,
					'pm_file_type' => $mimeType,
					'pm_extension' => $extension,
					'pm_size' => $size,
					'pm_cat' => $request->input('name'),
					'pm_status' => 2,
				];	
				
				
				
				
				try{
					$newData = PostMediaModel::create($data);					
					
					$responseData = [
						'fileName'=>$file[0],
						'name'=>$nameOnly.'.'.$extension,
						'fieldName'=>$request->input('name'),
						'size'=>$size,
						'mimeType'=>$mimeType,
						'id'=>$newData->pm_id
					];
					
					$postSlug = $request->input('slug');
					
					$name = $request->input('name');
					
					/*pre($this->imageDimesions[trim($name)]);
					pre($this->imageDimesions[$request->input('name')]);
					
					nouphal change made revert back
					
					
					if(!empty($postSlug ) && !empty($this->imageDimesions[$request->input('slug')])){
						//pre('asd');	
						$this->resize_image($file[0],$this->uploadPath,$this->imageDimesions[$request->input('slug')]);
					}
					
					// $this->resize_image
					*/
					
					if(!empty($postSlug ) && !empty($this->imageDimesions[$request->input('name')])){
						
						$this->resize_image($file[0],$this->uploadPath,$this->imageDimesions[$request->input('name')]);
					}else if(!empty($this->imageDimesions[$request->input('slug')])){
						$this->resize_image($file[0],$this->uploadPath,$this->imageDimesions[$request->input('slug')]);
					}						
					
					return response()->json(array('status'=>true,'data'=>$responseData));
				}catch(Exception $e){
					return response()->json(array('status'=>false,'data'=>$responseData,'message'=>lang('db_operation_failed')));
				}

			}

		}
		
		return response()->json(array('status'=>false,'message'=>lang('no_file_uploaded')));
	}
	
	public function save_youtube_video(Request $request){
		if(!$request->ajax()){
			return redirect()->to(apa('dashboard'));
		}
		
		if($request->input('youtubeURL')){
			
			$youtubeURL = $request->input('youtubeURL');
			$videoID = getYoutubeVideoID($youtubeURL);
			if(empty($videoID)){
				return response()->json(array('status'=>false,'message'=>lang('invalid_youtube_url')));
			}
			
			
			
			$data = [
				'pm_media_type' => 'video',
				'pm_cat' => 'video',
				'pm_lang' =>  $request->input('videoLang'),
				'pm_name' => $videoID,
				'pm_title' => $request->input('videoTitle'),
				'pm_title_arabic' => $request->input('videoTitleAr'),
				'pm_source'=>$request->input('videoSource'),
				'pm_source_arabic' => $request->input('videoSourceAr'),
				'pm_status' => 1,
			];
			
			
				
			try{

				$customImageId = $request->input('customImage');
				
				
				$postDetails = PostMediaModel::find($customImageId);
				
				if(!empty($customImageId)){
					PostMediaModel::where('pm_post_id','=',$postDetails->post_id)->update($data);
				}else{			
					$postDetails = PostMediaModel::create($data);					
				}
				
				$responseData = [
					'video'=>$videoID,
					'fileName'=>$postDetails->pm_file_hash,
					'title'=>$postDetails->pm_title,
					'titleAR'=>$postDetails->pm_title_arabic,
					'source'=>$postDetails->pm_source,
					'sourceAR'=>$postDetails->pm_source_arabic,
					'lang'=>$postDetails->pm_lang,
					'fieldName'=>'video',
					'size'=>$videoID,
					'type'=>'video',
					'id'=>$postDetails->pm_id
				];
				
				return response()->json(array('status'=>true,'data'=>$responseData));
			}catch(Exception $e){
				return response()->json(array('status'=>false,'data'=>$responseData,'message'=>lang('db_operation_failed')));
			}
				

		}

		
		
		return response()->json(array('status'=>false,'message'=>lang('no_file_uploaded')));
	}

	public function delete($fileID, Request $request){

		$postMedia = PostMediaModel::find($fileID);
		if(empty($postMedia)){
			if($request->ajax()){
				return response()->json(array('status'=>false,'message'=>'Invalid Request'));
			}
			return redirect()->to(adminPrefix().'dashboard')->with('userMessage',$message);
		}
		
		try{
			$request->flash();
						
			$update = $postMedia->where('pm_owner_id','=',Auth::user()->id)
					  ->where('pm_id','=',$fileID)
					  ->update(['pm_status'=>3]);
			$postMedia->delete();
		}
		catch(\Exception $e){
			$request->flash();
			return response()->json(['status'=>false,'message'=>lang('invalid_file')]);
		}
		
		return response()->json(['status'=>true,'message'=>lang('file_deleted')]);
	}
	
	public function update_priority(Request $request){ 
		
		$gallaeryIds=$request->ids;
		$priority=1;
		
		foreach($gallaeryIds as $galId){
			PostMediaModel::where('pm_id', '=', $galId)->update(['pm_priority'=>$priority]);
			$priority++;
			
		}
		
	}
	
	public function update_text(Request $request){ 
		$id=$request->_text_id;
		$dbColoumn=$request->_text_type;
		$_text= (empty($request->_text))?"NULL":$request->_text;		
		try{
			PostMediaModel::where('pm_id', '=', $id)->update([$dbColoumn=>$_text]);			
			return response()->json(['status'=>true,'message'=>'Text Updated']);
		}catch(\Exception $ex){
			$request->flash();
			if($request->ajax()){
				return response()->json(['status'=>false,'message'=>'Cannot update text']);
			}
			
			return redirect()->to(apa('/dashboard'))->with('errorMessage',lang('invalid_request'));
		}
		
	}
	
	public function post_media_download ($fileID, Request $request){
		
		if(empty($fileID)){ return response()->json(['status'=>false,'message'=>lang('invalid_file')]); }
		
		try{
			
			
			
			
			
			if(Auth::user()){
				if(Auth::user()->isAdmin()){
					$fileDetails = 	PostMediaModel::
							where('pm_id','=',$fileID)
							->first();
					// pre($fileDetails);
				}else{
					$fileDetails = 	PostMediaModel::
							join('users as U','U.id','=','pm_owner_id')
							->where('pm_id','=',$fileID)
							->where('pm_owner_id','=',Auth::user()->id)
							->first();
					
				}
			} 
			
			
			
			// pre($fileDetails);
			
			
			if(empty($fileDetails)){
				// pre($fileDetails);
				return redirect()->to(apa('/dashboard'))->with('errorMessage',lang('invalid_request'));
			}
			
			
			if($fileDetails->pm_type =='video' && empty($fileDetails->pm_extension)){
				// pre('asd');
				return redirect()->to(apa('/dashboard'))->with('errorMessage','Youtube video cannot be downloaded');
			}
			
			
			
			
			$pathToFile = './storage/app/public/post/'.$fileDetails->pm_file_hash;
			
			$name = $fileDetails->pm_name.'.'.$fileDetails->pm_extension;
			
			// pre($pathToFile);
			
			return response()->download($pathToFile, $name);
		}
		catch(\Exception $ex){
			// pre($ex->getMessage());
			$request->flash();
			// die($ex->getMessage());
			return redirect()->to(apa('/dashboard'))->with('errorMessage',lang('invalid_request'));
		}
		// die('aaaa');
		return redirect()->to(apa('/dashboard'))->with('errorMessage',lang('invalid_request'));
		
	}
}