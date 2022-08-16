<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Admin\Base\AdminBaseController;
use Illuminate\Support\Facades\Redirect;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use App\User as User;
use Auth;
use Input;
use Config;
use Session,
    DB,
    View;
class SettingController extends AdminBaseController {
	protected $roleName;
    public function __construct(Request $request){
		 parent::__construct($request);
		$this->roleName = 'Super Admin';
    }
	protected function checkPermission($name){
		return ($this->userObj->can($name)) ? true : false;
	}
    public function index(Request $request) {
        /* if( !$this->userObj->hasRole($this->roleName) ){
			return Redirect(route('admin_dashboard'))->with('userMessage','Invalid Permission') ;
		} */
        $this->data['messages'] ='';
        if ($request->input('updatebtnsubmit')) {
			
			
            $this->datasupdate =  $request->input('setting');
			//pre( $this->datasupdate);
            $this->datasupdate['sitename'] =  $request->input('sitename');
            $this->datasupdate['enquiry_send_email'] = trim($request->input('enquiry_send_email'));
            $this->datasupdate['site_meta_title'] = $request->input('site_meta_title');
            $this->datasupdate['site_meta_title_arabic'] = $request->input('site_meta_title_arabic');
            $file = $request->file('sitelogo_english');
            if ($file) {
                list($fileName, $fileNameWithPath) =
                        $this->store_file('sitelogo_english','public/uploads/logo');
                $this->datasupdate['sitelogo_english'] = $fileName;
            }
            $file1 =  $request->file('sitelogo_arabic');
            if ($file1) {
                list($fileName, $fileNameWithPath) =  $this->store_file('sitelogo_arabic','public/uploads/logo');
                $this->datasupdate['sitelogo_arabic'] = $fileName;
            }
            $file2 =
                    $request->file('sublogo_english');
            if ($file2) {
                list($fileName, $fileNameWithPath) =
                        $this->store_file('sublogo_english', 'public/uploads/logo');
                $this->datasupdate['sublogo_english'] = $fileName;
            }
            $file3 =
                    $request->file('sublogo_arabic');
            if ($file3) {
                list($fileName, $fileNameWithPath) = $this->store_file('sublogo_arabic','public/uploads/logo');
                $this->datasupdate['sublogo_arabic'] = $fileName;
            }
            $file6 = $request->file('location_map');
            if ($file6) {
                list($fileName, $fileNameWithPath) = $this->store_file('location_map','public/uploads/location-map');
                $this->datasupdate['location_map'] = $fileName;
                $this->datasupdate['location_map_file_ext'] = $file6->getClientOriginalExtension();
            }
          
            $settingsObj = SettingModel::find(1)->first();
			// pre($this->datasupdate);
			foreach($this->datasupdate as $key=>$val){
				
				$this->datasupdate[$key]=strip_tags($val);
			}
			$settingsObj->update($this->datasupdate);
            $this->data['messages'] = $this->custom_message('Updated Successfully','success');
        }
        $this->data['rssetting'] = SettingModel::find(1);
		//pre( $this->data['rssetting']);
        return view('admin.setting.edit',$this->data);
    }
}