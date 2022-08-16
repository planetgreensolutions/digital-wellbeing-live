<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Base\AdminBaseController;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admodels\CollectionMasterModel;
use App\Models\Admodels\CollectionContentModel;
use App\Models\Admodels\PageModel;
use Illuminate\Http\Request;
use App\User as User;
use Auth;
use Input;
use Config;
use DB;
use File;
use Response;
use App\Models\Admodels\GalleryModel;

class GalleryController extends AdminBaseController 
{
		
	public function __construct(Request $request)
	{
		parent::__construct($request);
		$this->data['postType'] = 'gallery';
		$this->data['hasGallery'] = true;
	}
		
		
	public function image_gallery_index()
	{
		
		$this->data['albumList'] = GalleryModel::where('gallery_image_type',1)->get();
		return view('admin.gallery.add',$this->data);
	}
		
	public function image_gallery_logo_index()
	{
		$this->data['albumList'] = GalleryModel::where('gallery_image_type',3)->get();
		return view('admin.gallery.logo',$this->data);
	}
		
		
	public function youtube_gallery()
	{
		
		$this->data['galleryVideoList'] = GalleryModel::where('gallery_image_type',2)->get();
		return view('admin.gallery.image_gallery',$this->data);
	}
		
		
	public function image_gallery($categoryID,Request $request)
	{

		if(empty($categoryID)) 
		{
			if($this->isBackendUser){
				return App::make('UsersController')->callAction('admin_errorpage',$this->data);
			}
			return App::make('HomeController')->callAction('errorpage',$this->data);
		}
		
		$categoryDetails = DB::table('gallery_category')
							->where('gc_id','=',$categoryID)
							->get();
		
		if(empty($categoryDetails)) 
		{
			if($this->isBackendUser){
				return App::make('UsersController')->callAction('admin_errorpage',$this->data);
			}
			return App::make('HomeController')->callAction('errorpage',$this->data);
		}

		if($request->get('updateytbsubmit'))
		{
			
			$insertDatas = array();
			$editID =$request->get('gallery_id');
			
			$youtubeEnglish = $request->get('youtube_video');
			if(!empty($youtubeEnglish))
			{
				foreach($youtubeEnglish as $key => $yEng)
				{
					$insertDatas[$key]['youtube_video'] = $this->getYoutubeID($yEng);
					$insertDatas[$key]['gallery_image_name'] = $yEng;
				}
			}
			
			$thumbnails = $request->get('old_youtube_video_thumbnail');
			if(!empty($thumbnails))
			{
				foreach($thumbnails as $key => $thumbnail)
				{
					$insertDatas[$key]['youtube_video_thumbnail'] = $thumbnail;
				}
			}
			
			$thumbnails = $request->file('youtube_video_thumbnail');
			if(!empty($thumbnails))
			{
				foreach($thumbnails as $key => $thumbnail)
				{
					if(!empty($thumbnail)){
						$filename = $this->resize_and_crop_image_youtube($thumbnail,'storage/app/public/uploads/gallery/youtube/',array(array('width'=>800,'height'=>460,'folder'=>'recommended'),array('width'=>400,'height'=>230,'folder'=>'small')),null );
						$insertDatas[$key]['youtube_video_thumbnail'] = $filename;
					}
				}
			}
			foreach($insertDatas as $key => $data)
			{
				$insertDatas[$key]['gallery_image_type'] = 2;
				$insertDatas[$key]['gallery_cat_id'] = $categoryID;
				$insertDatas[$key]['gallery_image_date'] = date('Y-m-d H:i:s');
			}
			
			GalleryModel::where('gallery_image_type',2)->where('gallery_cat_id','=',$categoryID)->delete();
			
			if(!empty($insertDatas))
			{
				foreach($insertDatas as $key => $data)
				{
					GalleryModel::insert( $data);
				}
			}				
		}
		
		$this->data['galleryVideoList'] = GalleryModel::where('gallery_image_type',2)->where('gallery_cat_id','=',$categoryID)->get();
		
		$tmp =  DB::table('gallery_category')
				->where('gc_id','=',$categoryID)
				->first();
		$this->data['categoryName'] = $tmp->gc_name;
		$this->data['imageGalleryID'] = $categoryID;
		return view('admin.gallery.add',$this->data);
	}
		
	public function create_category(Request $request)
	{
		if($request->input('createbtnsubmit')){
			$insertDatas = array(
			'gc_name' =>$request->input('gallery_cat_name'),
			'gc_slug' =>str_slug(trim(strtolower($request->input('gallery_cat_name')))),
			'gc_page_id' =>$request->input('cm_page_id'),
			'cm_content_id' =>$request->input('cm_content_id'),
			'gc_type'=>$request->input('gc_type'),
			'gc_large_width' =>$request->input('large_width'),
			'gc_large_height' =>$request->input('large_height'),
			'gc_medium_width' =>$request->input('medium_width'),
			'gc_medium_height' =>$request->input('medium_height'),
			'gc_small_width' =>$request->input('small_width'),
			'gc_small_height' =>$request->input('small_height'),
			'gc_priority' =>$request->input('priority'),
			'gc_datetime' =>date('Y-m-d H:i:s'),								
			'gc_status' =>1,
			);
			DB::table('gallery_category')->insertGetId($insertDatas);
			$this->data['messages'] = $this->custom_message('Category name saved successfully.','success');
		}
		$pageList = Pagemodel::orderBy('page_parent_id','asc')->get();
		$allPages = $this->buildTree($pageList);
		$this->data['pageTreeAdminSelect'] = $allPages;
		$this->data['ccSelect'] = CollectionContentModel::getAllCollectionContentsWithCategory();
		$this->data['albumList'] = DB::table('gallery_category')->get();
		return view(Config::get('app.admin_prefix').'/gallery.create_category',$this->data);
	}
		
	public function update_category($editID, Request $request)
	{
		if(empty($editID)) { return redirect()->to(\Config::get('app.admin_prefix').'/gallery.list_category');}
		$this->data['messages']	='';
		
		if($request->input('updatebtnsubmit')){
			
			$insertDatas = array(
			'gc_name' =>$request->input('gallery_cat_name'),
			'gc_page_id' =>$request->input('cm_page_id'),
			'cm_content_id' =>$request->input('cm_content_id'),
			'gc_type'=>$request->input('gc_type'),
			'gc_large_width' =>$request->input('large_width'),
			'gc_large_height' =>$request->input('large_height'),
			'gc_medium_width' =>$request->input('medium_width'),
			'gc_medium_height' =>$request->input('medium_height'),
			'gc_small_width' =>$request->input('small_width'),
			'gc_small_height' =>$request->input('small_height'),
			'gc_priority' =>$request->input('priority'),
			'gc_datetime' =>date('Y-m-d H:i:s'),								
			'gc_status' =>1,
			);
			$galleryObj = DB::table('gallery_category')->where('gc_id',$editID)->first();
			$galleryObj->update($insertDatas);
			$this->data['messages'] = $this->custom_message('Category name saved successfully.','success');
		}
		$pageList = Pagemodel::orderBy('page_parent_id','asc')->get();
		$allPages = $this->buildTree($pageList);
		$this->data['pageTreeAdminSelect'] = $allPages;
		$this->data['catOne'] = DB::table('gallery_category')->where('gc_id',$editID)->first();
		$this->data['ccSelect'] = CollectionContentModel::getAllCollectionContentsWithCategory();
		return view(Config::get('app.admin_prefix').'/gallery.edit_category',$this->data);
	}
		
	
	public function list_category()
	{	
		$this->data['catList'] = DB::table('gallery_category AS GC')
									->leftJoin('pages AS P','P.page_id','=','GC.gc_page_id')
									->get();
		return view(Config::get('app.admin_prefix').'/gallery.list_category',$this->data);
	}
		
	public function category_changestatus($statusID,$currentStatus)
	{
		$currentStatus = ($currentStatus==0)?1:0;
		$currentStatusdatas = array("gc_status"=>$currentStatus);
		DB::table('gallery_category')->where('gc_id', '=',$statusID)->update($currentStatusdatas);
		return Redirect::to(Config::get('app.admin_prefix').'/image-gallery/category-list')->with('userMessage',$this->custom_message('Status changed successfully.','success'));
	}
		
	
	public function category_delete($deleteID)
	{
		if(empty($deleteID)) { return Redirect::to(Config::get('app.admin_prefix').'/image-gallery/category-list'); }
		$details = GalleryModel::where('gallery_cat_id', '=',$deleteID)->get();
		if(!empty($details)){
			foreach($details as $list){
				if(!empty($list->gallery_image_name) && File::exists('storage/app/public/uploads/gallery/'.$list->gallery_image_name) ){
					
					File::delete('storage/app/public/uploads/gallery/'.$list->gallery_image_name);
					File::delete('storage/app/public/uploads/gallery/thumb/'.$list->gallery_image_name);
					File::delete('storage/app/public/uploads/gallery/small/'.$list->gallery_image_name);
					File::delete('storage/app/public/uploads/gallery/large/'.$list->gallery_image_name);
				}
				if(!empty($list->gallery_image_name) && File::exists('storage/app/public/uploads/gallery/youtube/'.$list->gallery_image_name) ){
					File::delete('storage/app/public/uploads/gallery/youtube/'.$list->gallery_image_name);
					File::delete('storage/app/public/uploads/gallery/youtube/thumb/'.$list->gallery_image_name);
					File::delete('storage/app/public/uploads/gallery/youtube/small/'.$list->gallery_image_name);
					File::delete('storage/app/public/uploads/gallery/youtube/large/'.$list->gallery_image_name);
				}
				
			}
		}
		GalleryModel::where('gallery_cat_id', '=',$deleteID)->delete();
		DB::table('gallery_category')->where('gc_id', '=',$deleteID)->delete();
		$this->data['messages'] = $this->custom_message('Deleted Successfully','success');
		return Redirect::to(Config::get('app.admin_prefix').'/image-gallery/category-list')->with('flash_error','deleted');
		
	}

	public function video_gallery()
	{
		if(Input::get('createbtnsubmit')){
			
			
			$links = Input::get('shows_link');
			
			if(!empty($links)){
				$insertDatas = array();
				DB::table('video_gallery')->delete();
				foreach($links as $url){
					if(!empty($url)){
						$videoID='';
						if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
							$videoID = $id[1];
							} else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
							$videoID = $id[1];
							} else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
							$videoID = $id[1];
							} else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
							$videoID = $id[1];
						}
						else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
							$videoID = $id[1];
						}
						if(!empty($videoID)){
							$insertDatas[] = array(
							'vg_video_link' =>$url,
							'vg_youtube_id' =>$videoID,
							'vg_status' =>2,
							'vg_date' =>date('Y-m-d'),
							'vg_cat_id' =>Input::get('circleID'),
							'vg_status' =>1
							);
							
							}else{
							$this->data['message'] = 'Invalid Youtube URL';
						}
					}
				}
				DB::table('video_gallery')->insert($insertDatas);
			}
			
		}
		$this->data['categoryList'] =  DB::table('gallery_category')->get();
		$this->data['videoList'] = DB::table('video_gallery')->get();
		return view('admin.gallery.addVideo',$this->data);
	}
		
	public function delete_video_gallery($circleID, $deleteID)
	{
		if(empty($circleID)) { return Redirect::to(Config::get('app.admin_prefix').'circles'); }
		if(empty($deleteID)) { return Redirect::to(Config::get('app.admin_prefix').'circle/edit/'.$circleID);}
		$details = GalleryModel::where('gallery_id', '=',$deleteID)->first();
		if(!empty($details)){
			if(!empty($details->gallery_image_name) && File::exists('storage/app/public/uploads/gallery/'.$details->gallery_image_name) ){
				File::delete('storage/app/public/uploads/gallery/'.$details->gallery_image_name);
				File::delete('storage/app/public/uploads/gallery/thumb/'.$details->gallery_image_name);
				File::delete('storage/app/public/uploads/gallery/small/'.$details->gallery_image_name);
				File::delete('storage/app/public/uploads/gallery/large/'.$details->gallery_image_name);
			}
			GalleryModel::where('gallery_id', '=',$deleteID)->delete();
			$this->data['messages'] = $this->custom_message('Deleted Successfully','success');
		}
		return Redirect::to(Config::get('app.admin_prefix').'/circle/edit/'.$circleID)->with('flash_error','deleted');	
	}
		
		
	public function get_old_files(Request $request)
	{
		$post_id=input::get('post');
		$oldFiles = array();
		
		$oldFiles	= DB::table('gallery_images AS GI')						 
					->where('gallery_post_id',$post_id)
					->where('gallery_image_type','=',1)						 
					->orderBy(DB::raw('GI.gallery_id'),'DESC')
					->get();
		echo json_encode(array('status'=>true, 'gallery'=>$oldFiles));
		exit();
	}
		
	public function get_old_files_logo(Request $request)
	{
		$oldFiles = array();
		
		$oldFiles	= DB::table('gallery_images AS GI')
						->where('gallery_image_type','=',3)						 
						->orderBy(DB::raw('GI.gallery_id'),'DESC')
						->get();
		
		echo json_encode(array('status'=>true, 'gallery'=>$oldFiles));
		exit();
	}
		
	public function file_upload(Request $request)
	{
		if($request->hasFile('file')){
			$type=$request->type;
			
			switch($type){
				case 'banner':
				
				break;
				
				default:
				
				break;
			}

			$filePath = 'public/uploads/gallery/';
			list($fileName, $fileNameWithPath) = $this->store_file('file', 'public/uploads/gallery');
			$this->resize_image($fileName,$filePath,array(
				'thumbnail'=> array('height' => 469,'width'=> 500),
				'large'=> array('height' => 800,'width'=> 1200), 
				'small'=>array('height' => 150,'width'=> 150)
			),true);
			$fileName= ($fileName)?$fileName:null;					
			$id=0;
			if(!empty($fileName)){
				$insertDatas = array(
				'gallery_post_id' =>'0',
				'gallery_image_name' =>$fileName,
				'gallery_image_type' =>1,
				'gallery_image_date' =>date('Y-m-d H:i:s'),
				'gallery_image_status' =>1
				);
				$id = GalleryModel::insertGetId($insertDatas);
			}
			$data = DB::table('gallery_images AS GI ')
						->where('gallery_image_type','=',1)
						->where('gallery_id','=',$id)
						->first();
			echo json_encode(array('uploadDetails'=>array('status'=>true,'fileName'=>$data->gallery_image_name,'id'=>$data->gallery_id)));
			exit();
		}
	}
	
	public function album_category_changestatus($statusID,$currentStatus)
	{
		$currentStatus = ($currentStatus==0)?1:0;
		$currentStatusdatas = array("gc_status"=>$currentStatus);
		DB::table('gallery_category')->where('gc_id', '=',$statusID)->update($currentStatusdatas);
		return Redirect::to(Config::get('app.admin_prefix').'/image-gallery')->with('userMessage',$this->custom_message('Status changed successfully.','success'));
	}
		
	public function gallery_changestatus($statusID,$currentStatus)
	{
		$currentStatus = ($currentStatus==0)?1:0;
		$currentStatusdatas = array("gallery_image_status"=>$currentStatus);
		GalleryModel::where('gallery_id', '=',$statusID)->update($currentStatusdatas);
		return Redirect::to(Config::get('app.admin_prefix').'/image-gallery')->with('userMessage',$this->custom_message('Status changed successfully.','success'));
	}
		
	public function album_delete_gallery_image($id)
	{
		$imageDetails = 	DB::table('gallery_images')
							->where('gallery_cat_id','=',$id)
							->get();
							
		if(!empty($imageDetails)){
			foreach($imageDetails as $imageDetail){
				if(!empty($imageDetail->gallery_image_name) && File::exists('storage/app/public/uploads/gallery/'.$imageDetail->gallery_image_name) ){
					
					File::delete('storage/app/public/uploads/gallery/'.$imageDetail->gallery_image_name);
					File::delete('storage/app/public/uploads/gallery/thumb/'.$imageDetail->gallery_image_name);
					File::delete('storage/app/public/uploads/gallery/small/'.$imageDetail->gallery_image_name);
					File::delete('storage/app/public/uploads/gallery/large/'.$imageDetail->gallery_image_name);
					
				}
				GalleryModel::where('gallery_cat_id', '=', $id)->delete();
				
			}
		}
		DB::table('gallery_category')->where('gc_id', '=',$id)->delete();
		if(Request::ajax()){
			echo json_encode(array('status'=>true,'Message'=>'File Deleted'));
		}else{
			return Redirect::to(Config::get('app.admin_prefix').'/image-gallery')->with('userMessage',$this->custom_message('Album deleted successfully.','success'));
		}
	}
		
	public function file_upload_logo(Request $request)
	{
		
		if($request->hasFile('file')){

			$largeWidth='960';
			$largeHeight= '662';
			$mediumWidth= '600';
			$mediumHeight= '450';
			$smallWidth= '400';
			$smallHeight= '300';
			$filePath = 'public/uploads/gallery/logo/';
			list($fileName, $fileNameWithPath) = $this->store_file('file', 'public/uploads/gallery/logo/');
			$this->resize_image($fileName,$filePath,array('large'=> array('height' => 400,'width'=> 700), 'small'=>array('height' => 150,'width'=> 150)));
			$fileName= ($fileName)?$fileName:null;		
			$id=0;
			if(!empty($fileName)){
				$insertDatas = array(
				'gallery_cat_id' =>'0',
				'gallery_image_name' =>$fileName,
				'gallery_image_type' =>3,
				'gallery_image_date' =>date('Y-m-d H:i:s'),
				'gallery_image_status' =>1
				);
				$id = GalleryModel::insertGetId($insertDatas);
			}
			$data = DB::table('gallery_images AS GI ')
						->where('gallery_image_type','=',3)
						->where('gallery_id','=',$id)
						->first();

			echo json_encode(array('uploadDetails'=>array('status'=>true,'fileName'=>$data->gallery_image_name,'id'=>$data->gallery_id)));
			exit();
		}
	}
		
		
		
	public function delete_gallery_image($id,Request $request)
	{
		$imageDetail = 	DB::table('gallery_images')
						->where('gallery_id','=',$id)
						->first();
		if(!empty($imageDetail)){
			if(!empty($imageDetail->gallery_image_name) && File::exists('storage/app/public/uploads/gallery/'.$imageDetail->gallery_image_name) ){
				File::delete('storage/app/public/uploads/gallery/'.$imageDetail->gallery_image_name);
				File::delete('storage/app/public/uploads/gallery/thumb/'.$imageDetail->gallery_image_name);
				File::delete('storage/app/public/uploads/gallery/small/'.$imageDetail->gallery_image_name);
				File::delete('storage/app/public/uploads/gallery/large/'.$imageDetail->gallery_image_name);
			}
			GalleryModel::where('gallery_id', '=', $id)->delete();
		}
		
		if($request->ajax()){
			echo json_encode(array('status'=>true,'Message'=>'File Deleted'));
		}else{
			return Redirect::to(Config::get('app.admin_prefix').'/image-gallery')->with('userMessage',$this->custom_message('Album deleted successfully.','success'));
		}
	}
				
	public function download_image($imageName)
	{
			
		if(!empty($imageName) && File::exists('storage/app/public/uploads/gallery/large/'.$imageName) ){
			return Response::download('storage/app/public/uploads/gallery/large/'.$imageName, $imageName);
		}
		
		return Redirect::to(\Config::get('app.admin_prefix'));
	
	}
		
	public function save_image_title(Request $request)
	{
		
		if($request->ajax()){
			$galleryId = $request->input('id');
			$value = $request->input('value');
			$field = $request->input('field');
			$response = (['status'=>false,'userMessage'=>'Error saving data, Please refresh and try again.']);
			if(!empty($galleryId) && !empty($field)){
				$updateData = null;
				switch($field){
					case 'title':
						$updateData=['gallery_image_title'=>$value];
					break;
					case 'title_ar':
						$updateData=['gallery_image_title_arabic'=>$value];
					break;
					default:
					
					break;
					
				}
				if(!empty($updateData)){
					$galleryObj = GalleryModel::where('gallery_id', '=', $galleryId)->first();
					$galleryObj->update($updateData);
					$response = (['status'=>true,'userMessage'=>'Data saved']);
				}
			}
			return Response::json($response);
			
		}
		return Redirect(Config::get('app.admin_prefix'));
					
	}
				
}
								