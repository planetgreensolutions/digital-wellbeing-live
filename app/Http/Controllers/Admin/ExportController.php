<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Redirect;
use \App\ExcelHelper;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Base\AdminBaseController;
use App\User;
use App\Exports\UsersExport;
use App\Exports\RegisterExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends AdminBaseController {
	
	public function __construct(Request $request){
		parent::__construct($request);
		
	}
	
	/*
	* Works in combination with createZip method, using ExcelHelper with Matweb Excel, Fore more info use new ExcelHelper->help()
	* @args Request , Laravel Model Object , Bool
	* @return mixed [null , Response, ]
	*/
	
	private function _formatHTMLEntities($data){
		$string = htmlentities($data, null, 'utf-8');
		$string = str_replace(["&nbsp;",'&lrm;'], " ", $string);
		$string = rtrim($string);
		$string = strtolower(trim($string));
		$string = str_replace('&amp;#39;','\'',$string);
		return html_entity_decode($string);
	}
	
	public function index(Request $request , $modelSlug){
		$type = ($request->input('type'));
		$fileType = ($type == 'excel') ? '.xlsx' : 'pdf';
		switch($modelSlug){
			case 'users':
				return Excel::download(new UsersExport($request), 'users.'.$fileType);
			break;
			default:
			
			break;
		}
		return Redirect(Config::get('app.admin_prefix').'/dashboard');
		
	}
	
	public function register(Request $request){
		
		$this->data['register'] =   User::orderBy('created_at','desc')
									->where('is_admin','<>',1)
									->paginate(20);
		return view('admin.export.register',$this->data);
	}
	

	protected function exportAsExcelOrZip(Request $request,$dataObject,$type='excel'){
		
		/* if Var $zip is true, Then the request will be for a zip file including the xls & attachments*/
		if(empty($dataObject)){return false;}
		// pre($dataObject);
		$excelHelper  = new ExcelHelper;

		$headers = [
			'Sl No',
			'User Type',
			'Registration Code',
			'Prefix',
			'First Name ',
			'Last Name ',
			'Email', 
            'Alternate Email',
			'Nationality',
			'Emirate',
            
            'Gender',
            'DOB',
            'Phone Country Code',
            'Phone Number',
            
			'Education Institution',
			'Education Institution Other',
			'Year Of Study',
			'User Email Verified ?',
			'User status',
			'Date of registration',
			'Passion',
			'Emails Invited',
			'Reason For attending',
			'Ratings',
            
            'Who Would You Meet',
            'Who Am I',
            'Biggest Fears',
            'Personal Intersts',
            'Major',
            
            'Onsite Mob Country Code',
            'Onsite Mobile Number',
            'Method of transportation',
            'Passport No',
            'UID No',  
			
			'EID No',  
           'First name in Passport',  
           'Last name in Passport',  
           'Place of issue',  
           'Date of issue',  
           'Passport expiry date',  
           'Residence visa issue date',  
           'Residence visa expiry date',  
			'Download (Copy Paste in browser)'
           
            
		];
		
		$excelHelper->setColumnOptions(['A1:AG1'=>['size'=> '12','bold'=>true]])
					->setExcelHeader($headers);

		$slNo=  1;
		$zipArr = [];
		$registrantName = null;
		foreach($dataObject as $registrant){ 
						
            
			$registrantName = $registrant->name;
            
			if($type =='zip'){
                // echo 'asd';
				$zipArr[] = $this->createZip($request,$registrant,false,null);
			}
            
			$ratingDOM = '';
			if(!empty($registrant->user_rating)) {
				$ratingEnglish = explode('|',$registrant->user_rating_english);
				$rating = explode('|',$registrant->user_rating);
				
				foreach($ratingEnglish as $key=>$english){
					
					if(!isset($rating[$key])) { 
						continue;
					}
					$ratingDOM.= $english.'('.$rating[$key].') , ' ;
				}

			}
            $whoAmI = '';
            if(in_array($registrant->user_prefix,['Dr.','Prof.'])){
                
                $whoAmI = ( $registrant->who_am_i == 1) ? 'Invitee' : 'Accompanying Teacher';
                
            }
            
            $regStatus = '';
            list($class,$statusLabel) = getMBZStatusLabel($registrant->status);
            
		
			$eachRow = [
				$slNo,
	
				($registrant->user_type==2)?'Teacher':'Student',
                
				$registrant->user_unique_code,
				$registrant->user_prefix,
				$registrant->user_first_name,
				$registrant->user_last_name,
				$registrant->email,
				$registrant->user_alternate_email,
				$registrant->nationality,
				$registrant->emirate,
				$registrant->user_gender,
				$registrant->user_dob,
				$registrant->user_country_code,
				$registrant->user_phone_number,
                
				$this->_formatHTMLEntities($registrant->educational_institution_name),
				$registrant->educational_institution_other,
				$registrant->educational_year,
				($registrant->user_email_confirmed == 1) ? 'Confirmed' : 'Not Confirmed',
				$statusLabel   ,
				date('d M Y h:i A',strtotime($registrant->created_at)),
				$registrant->user_passion,
				str_replace('|',',',@$registrant->user_invitation),
				str_replace('|',',',@$registrant->user_reasons),
				$ratingDOM,
                
                $registrant->user_would_meet,
                $whoAmI,
                $registrant->user_fear_about,
                $registrant->user_personal_interest,
                $registrant->user_major,
                
                
                $registrant->onsite_mob_country_code,
                $registrant->onsite_mob_number,
                $registrant->method_of_transportation,
                $registrant->passport_number,
                $registrant->uid_number,
				
				(!empty($registrant->eid_number)) ? $registrant->eid_number : '-' ,
               (!empty($registrant->passport_first_name)) ? $registrant->passport_first_name : '-',
               (!empty($registrant->passport_last_name)) ? $registrant->passport_last_name : '-',
               (!empty($registrant->passport_place_of_issue)) ? $registrant->passport_place_of_issue : '-',
               (!empty($registrant->passport_date_of_issue) && $registrant->passport_date_of_issue !='0000-00-00' ) ? date('d M Y',strtotime($registrant->passport_date_of_issue)) : '-',
               (!empty($registrant->passport_expiry_date) && $registrant->passport_expiry_date !='0000-00-00' ) ? date('d M Y',strtotime($registrant->passport_expiry_date)) : '-',
               (!empty($registrant->residence_visa_issue_date) && $registrant->residence_visa_issue_date !='0000-00-00' ) ? date('d M Y',strtotime($registrant->residence_visa_issue_date)) : '-',
               (!empty($registrant->residence_visa_expiry_date) && $registrant->residence_visa_expiry_date !='0000-00-00' ) ? date('d M Y',strtotime($registrant->residence_visa_expiry_date)) : '-',            
				asset(Config::get('app.admin_prefix').'/registrations/download?registrationID='.$registrant->id.'&type=zip'),
                
                
			];	

			$excelHelper->setExcelData($eachRow);
			$slNo++;
		}

		$fileName = ($slNo<=2) ? $registrantName.' registration-file' : 'All-user-registration';
		$excelFileObj = $excelHelper->createExcel(false,$fileName);
	
		if($type == 'excel'){
			/* Send XLSX file only */
			$excelFileObj->download('xlsx');
			
		}else if($type == 'zip'){
			/* Save excel file and copy file path to array for final zipping along with other zips */
	
			$excelFileObj->save('xlsx');
			$zipArr[] = $excelFileObj->storagePath.DIRECTORY_SEPARATOR.$excelFileObj->filename.'.xlsx';
			return $this->createZip($request,null,true,$zipArr);
		}else if($type == 'csv'){
            return $excelFileObj->download('csv');
        }
        
        return response()->redirect(Config::get('app.admin_prefix').'/registrations');
	
	}
	
	
	/*
	* !!!!!!!!!!!! $massDownloads must be used only for zipping dynamically created files (zips and excel sheet),as this will delete the file at the end !!!!!!!!!!!!!!!!
	* @args Request , int , Bool , Array
	* @return mixed [null , Response, ]
	*/

	protected function createZip(Request $request, $registrant,$download=true,$massDownloads = null){
        // pre($registrant);
        
		$excludeVideo = true;
		$public_dir = storage_path('exports');
		$data = null;
		
		/*Will be a Mass Download including all individual Zips & excel sheet*/	
		if(empty($registrant) && !empty($massDownloads)) {

			$zipFileName = 'User-RegistrationData-attachments-'.rand().'.zip';
			$zip = new \ZipArchive;
			if($zip->open($public_dir . DIRECTORY_SEPARATOR  . $zipFileName, \ZipArchive::CREATE) === TRUE) {  
				foreach($massDownloads as $file){
					if(\File::exists($file)){
						$extension = \File::extension($file);
						$fileInsideZipName = pathinfo($file)['filename'].'.'.$extension;
						$zip->addFile($file,$fileInsideZipName);    						
					}
				}
				$zip->close();
				/* Delete File after adding to zip */
				foreach($massDownloads as $file){
					\File::delete($file);
				}
			}
		}
		/*Will be a single Zip which is not a mass download */	
		if(!empty($registrant)){
			$data = [
				['folder'=>'eid_front','label'=>'EID front','file'=>@$registrant->eid_front_image],
				['folder'=>'eid_back','label'=>'EID back','file'=>@$registrant->eid_back_image],
				['folder'=>'passport_uid','label'=>'Passport UID','file'=>@$registrant->passport_uid_image],
				['folder'=>'residence_visa','label'=>'Residence Visa','file'=>@$registrant->residence_visa_image],
			];           
	
			$registrantName = $registrant->name;
			$zipFileName = $registrantName .'_attachments_'.rand().'.zip';

			$zip = new \ZipArchive;
			if($zip->open($public_dir . DIRECTORY_SEPARATOR  . $zipFileName, \ZipArchive::CREATE) === TRUE) {  

					foreach($data as $key => $record){
                  
                        if(!empty($record['file'])){
                            $file = storage_path('app'.DIRECTORY_SEPARATOR .'public'.DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR .$record['folder'].DIRECTORY_SEPARATOR.$record['file']);

                            if(\File::exists($file)){
                            $extension = \File::extension($file);
                            $fileInsideZipName = $registrantName.'_'.$record['label'].'.'.$extension;
                            $zip->addFile($file,$fileInsideZipName);        
                            }
                        }
							
					}
					$zip->close();

			}
			
		}
		
		
		if(!empty($zipFileName)){
            
			$filetopath = $public_dir.'/'.$zipFileName;	
			
			if($download){
	
				$headers = array(
						'Content-Type' => 'application/octet-stream',
					);

				if(file_exists($filetopath)){
					
					return response()->download($filetopath,$zipFileName,$headers)->deleteFileAfterSend(true);
				}
			}else{
                // echo $filetopath.'<br/>';
				return $filetopath;
			}

		}
			
		return null;
			
			
	}	


    protected function exportEventRegList($dataObject,$fileName){
    	if(empty($dataObject)){return false;}
		$excelHelper  = new ExcelHelper;
		// $excelHelper->help();
       
         $arr=array();
        foreach($dataObject as $row){

        	foreach($row as $key=>$val){
        		$arr[]=str_replace('_',' ',$key);
        	}
        	
        }
        $headers = array_values($arr);
		
		$excelHelper->setColumnOptions(['A1:X1'=>['size'=> '12','bold'=>true]])
					->setExcelHeader($headers);
		
		
		foreach($dataObject as $val){ 
			
			$row=array_values($val);
			$excelHelper->setExcelData($row);
		}
		
		$excelFileObj = $excelHelper->createExcel(false,$fileName);
	
		$excelFileObj->download('xlsx'); 
    }
    protected function exportExcelWorkshopRegistrationList($dataObject){
		if(empty($dataObject)){return false;}
		$excelHelper  = new ExcelHelper;
		// $excelHelper->help();
		$headers = [
			'Sl No',
			'Name',
			'Email',
			'Phone Number',
			'Age',
			'Gender',
			'Event Name',
			'Transportation Required',
			'Date / Time',
		];
		
		$excelHelper->setColumnOptions(['A1:X1'=>['size'=> '12','bold'=>true]])
					->setExcelHeader($headers);

		$slNo=  1;
		
		
		foreach($dataObject as $val){ 
						
			
			$eachRow = [
				$slNo,
				$val->name,
				$val->email,
				$val->user_phone_number,
				ageFinder($val->user_dob),
				($val->user_gender=="m")?'Male':'Female',
				$val->post_title,
				($val->transportation==1)?"Yes":"No",
				date('d M Y h:i A',strtotime($val->ub_created_at)),
			];	

			$excelHelper->setExcelData($eachRow);
			$slNo++;
		}

		$fileName = "Workshop Booking list".date('Y-m-d H:i:s');
		$excelFileObj = $excelHelper->createExcel(false,$fileName);
	
		$excelFileObj->download('xlsx');
	}
	
	
	
	public function export_register(Request $request){
		$type = ($request->input('type'));
		$fileType = ($type == 'excel') ? '.xlsx' : 'pdf';
		return Excel::download(new RegisterExport($request), 'registation-list.'.$fileType);
	}
}