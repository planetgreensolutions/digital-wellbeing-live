<?php

namespace App\Http\Controllers\Admin;

use Validator, Input, Redirect,Auth,Config,DB;
use Illuminate\Support\Facades\Gate;
use App\User as User;
use Illuminate\Http\Request;
use App\Models\Admodels\PostMediaModel;
use File;
use Storage;
use App\Http\Controllers\Admin\Base\AdminBaseController;

class FileManagerController extends AdminBaseController {

	private $uploadPath = 'post/uploads';

	public function __construct(Request $request){
		parent::__construct($request);

	}
	
	public function clean_stale_entries(Request $request){
        
        
       
        $files =   PostMediaModel::where('pm_status','=',1)->where('pm_media_type','!=','video')->get();
		
		$deletedList = [];
		
		foreach($files as $file){
			if(! Storage::disk('local')->exists('post/large/'.$file->pm_file_hash)){
				$deletedList[] = $file;
				$file->delete();
				
			}
		}
		
        pre($deletedList);
    }
	
	public function file_browser_ckeditor(Request $request){
        
        
       
        $this->data['filemanagerFiles'] =   PostMediaModel::where('pm_media_type','!=','video')->paginate(50);
		// pre( $this->data['filemanagerFiles']);
        return view('admin.common.filemanager',$this->data)->render();
    }
    
    public function file_upload_ckeditor(Request $request){
        //pre($request->all());
        $fileType = $request->input('type');
        if(empty($fileType)){
            $fileType = 'file';        
        }
        $file = $this->store_file('upload',$this->uploadPath);
        
        
        if(!$file){
            return response()->json(['uploaded'=>0,'error'=>'Upload Error!']);
        }
		
		
		// pre($file);
		
		
		
		
		
       // pre($request->file('upload')->guessExtension());
        $nameOnly = basename($request->file('upload')->getClientOriginalName(), '.'.$request->file('upload')->getClientOriginalExtension());
        $extension = $request->file('upload')->getClientOriginalExtension();
        $size = $request->file('upload')->getClientSize();
        if( $fileType=='image' && !in_array($extension,['jpg','jpeg','gif','png','svg','svgz','bmp'])){
            return response()->json(['uploaded'=>0,'error'=>'Upload Error!. Only Image upload is permitted']);
        }
		$mimeType = $request->file('upload')->getClientMimeType();
        
        
       
       
        $data = [
			'pm_name' => $nameOnly,
			'pm_orig_name' => $file[1],
			'pm_file_hash' => $file[0],
			'pm_owner_id' => (Auth::user())?Auth::user()->id:null,
			'pm_file_type' => $mimeType,
			'pm_extension' => $extension,
			'pm_size' => $size,
			'pm_cat' => $request->input('name'),
			'pm_status' => 1,
		];	
				
      
		$newFile = PostMediaModel::create($data);		
		
        if(empty($newFile)){
            return response()->json(['uploaded'=>0,'error'=>'Upload Error!']);
        }

        return response()->json(['uploaded'=>1,'fileName'=>$file[0],'url'=>asset('storage/app/'.$this->uploadPath.'/'.$file[0]), 'id'=>$newFile->pm_id]);
    }
}
