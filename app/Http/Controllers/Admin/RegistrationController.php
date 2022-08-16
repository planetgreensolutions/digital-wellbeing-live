<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Admin\Base\AdminBaseController;
use Illuminate\Support\Facades\Redirect;
use App\Models\FormModel;
use App\Models\ShortlistModel;
use App\Models\AdModels\CountryModel;
use Auth;
use Input;
use Config;
use Session;
use DB;
use Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\NominationExport;
use App\Exports\RegisterExport;
use Maatwebsite\Excel\Facades\Excel;
use App\User;

use App\Models\Admodels\ContactModel;
use App\Models\Admodels\ReportModel;
use App\Exports\ReportRequestExport;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\Log;

class RegistrationController extends AdminBaseController {


	protected $roleNames;
	public function __construct(Request $request){

		parent::__construct($request);
		$this->module = 'Registration';
		
	}
	

	public function index(Request $request){
	    
		if(!$this->checkPermission('List')){
			return $this->returnInvalidPermission($request);
		}
		
		/* Coordinator Filter - Using Filters array here */
		if(Auth::user()->hasRole('Country Coordinator')){
			$request->request->add(['filter_user_nationality'=>\Auth::user()->user_nationality]);
		}

		$this->data['users'] = User::filter(function($queryObj,$filter,$value){
									$model = $filter['model'];
										if(isset($model['title_key'])){
											$filterField = $model['title_key'];
											$queryObj->whereHas('formSubmissions',function($q) use($value){
												$q->where('form_manager_id',$value);
											});
										}
									})
									->with(['formSubmissions'=>function($q){
										$q->where('form_status','=',1);
									}])
									->orderBy('created_at','desc')
									->where('is_admin','<>',1)
									->paginate(20);
		$this->data['filterDOM'] = User::getFilterDom($request);
		
		return view('admin.registrations.register_index',$this->data);

	}
	
	public function download_registration(Request $request){
		
		return Excel::download(new RegisterExport($request), 'registation-list.xlsx');
	}
	
	public function user_submission_list(Request $request, $userId){
		
		
		if(Auth::user()->hasRole('Country Coordinator')){
			$request->request->add(['filter_user_nationality'=>\Auth::user()->user_nationality]);
		}
	
		$user = User::filter()
					->with(['formSubmissions'=>function($q){
						$q->where('form_status','=',1);
					}])
					->where('is_admin','<>',1)
					->where('id','=',$userId)
					->first();
		if(empty($user)){
			$msg = '<div class="alert alert-danger">User Details Not found</div>';
			return redirect()->to(apa('registration',true))->with('userMessage',$msg);
		}
		
		if($user->formSubmissions && $user->formSubmissions->count() <= 0){
			$msg = '<div class="alert alert-danger">No Submissions found</div>';
			return redirect()->to(apa('registration',true))->with('userMessage',$msg);
		}
		$this->data['user'] = $user;

		$this->data['submissions'] = $user->formSubmissions()->where('form_status','=',1)->with(['entityCountry'])->paginate(15);
		return view('admin.registrations.register_submission_list',$this->data);
	}
	
	public function all_submission_list(Request $request){
		
		
		if(Auth::user()->hasRole('Country Coordinator')){
			$request->request->add(['filter_user_nationality'=>\Auth::user()->user_nationality]);
		}
		
		
		
		$allSubmissions  = 	FormModel::filter($request)
							->with(['formManager','entityLogo','entityCountry','formOwner','formAttachments'])
							
							->join('users AS U','U.id','=','form_user_id');
							
		if(Auth::user()->hasRole('Country Coordinator')){
			$allSubmissions->where('U.user_nationality','=',Auth::user()->user_nationality);
			
		}					
										
		
		$this->data['allSubmissions'] = $allSubmissions
										->where('U.id','<>',Auth::user()->id)
										->where('U.is_admin','<>',1)
										->orderBy('form_created_at','DESC')
										// ->get();
										->paginate(20);
		
		// $this->data['countryList'] = \CountryModel::where('country_status','=',1)->get();
		
		$this->data['filterDOM'] = FormModel::getModelFilterDom($request);
		
		return view('admin.registrations.all_submission_list',$this->data);
	}
	
	public function submission_shortlist(Request $request){
		
		
		if(Auth::user()->hasRole('Country Coordinator')){
			$request->request->add(['filter_user_nationality'=>\Auth::user()->user_nationality]);
		}
		
		
		
		$allSubmissions  = 	FormModel::filter($request)
							->with(['formManager','entityLogo','entityCountry','formOwner','formAttachments','shortLister'])							
							->join('users AS U','U.id','=','form_user_id');
							
		if(Auth::user()->hasRole('Country Coordinator')){
			$allSubmissions->where('U.user_nationality','=',Auth::user()->user_nationality);			
		}					
										
		
		$this->data['allSubmissions'] = $allSubmissions
										->where('U.id','<>',Auth::user()->id)
										->where('U.is_admin','<>',1)
										->where('shortlist_status','=',1)
										->orderBy('form_created_at','DESC')
										// ->get();
										->paginate(20);
		
		// $this->data['countryList'] = \CountryModel::where('country_status','=',1)->get();
		
		$this->data['filterDOM'] = FormModel::getModelFilterDom($request);
		
		return view('admin.registrations.submission_short_list',$this->data);
	}
	
	public function user_submission_details (Request $request,$userId, $submissionId){
		
		
		if(Auth::user()->hasRole('Country Coordinator')){
			$request->request->add(['filter_user_nationality'=>\Auth::user()->user_nationality]);
		}
	
		$user = User::filter()
					->where('is_admin','<>',1)
					->where('id','=',$userId)
					->with(['formSubmissions'=>function($q) use($submissionId){
						$q->where('form_status','=',1)
						  ->where('form_id',$submissionId); 
					}])
					->first();

		// pre($user->formSubmissions);
		
		if(empty($user) || empty($user->formSubmissions) ){
			$msg = '<div class="alert alert-danger">User Details Not found</div>';
			return redirect()->to(apa('registration',true))->with('userMessage',$msg);
		}
		
		
		$this->data['user'] = $user;
		/* form SUbmission fitered by id already, select the first item */
		$submission = $user->formSubmissions->first();
		
		if(empty($submission) ){
			$msg = '<div class="alert alert-danger">Invalid Form Requested</div>';
			return redirect()->to(apa('registration',true))->with('userMessage',$msg);
		}
		$this->data['submission'] =  $submission;
		$getDatamethodName = $submission->getMethodName(); 
		$this->data['preFilledForm'] = $submission->{$getDatamethodName}($submission->form_user_id,$submission->formManager->fm_category_slug,$submission->formManager->fm_form_slug);
		
		return view('admin.registrations.register_submission_details',$this->data);
	}
	
	public function download_user_submission(Request $request){
		$userId = $request->input('user');
		$submissionId = $request->input('submission');
		if(empty($userId)){
			$msg = '<div class="alert alert-danger">Invalid URL</div>';
			return redirect()->to(apa('dashboard',true))->with('userMessage',$msg);
		}
		
		$userTmp = User::filter()
					->where('is_admin','<>',1)
					->where('id','=',$userId);
		if($submissionId){
			$userTmp->with(['formSubmissions'=>function($q) use($submissionId){
						$q->where('form_status','=',1)
							->where('form_id',$submissionId);
				}]);
		}
		$user = $userTmp->first();
		$this->data['user'] = $user;

		$this->data['submissions'] = $user->formSubmissions;
		$pdfTemplate = 'admin.registrations.export.user_submission_export';
		if($request->input('html')){
			return View($pdfTemplate,$this->data);
		}
		$pdf = \PDF::loadView($pdfTemplate, $this->data);
		return $pdf->download('document.pdf');
	}
	
	public function complete_form_request($userId,$formId, Request $request){
		
		$formDetails =  FormModel::with(['formOwner'])
						 ->join('form_manager AS FM','FM.fm_id','form_submissions.form_manager_id')
						 ->where('form_user_id','=',$userId)
						 ->where('form_id','=',$formId)
						 ->first();
		// pre($formDetails);
		$data['formDetails'] = $formDetails; 
		$toEmail = $formDetails->formOwner->email;
		
		// pre(view('frontend.email_template.complete_form_reminder',$data)->render());
		try{
			Mail::send('frontend.email_template.complete_form_reminder',$data, function($message) use($toEmail){
				$message->to($toEmail)
				->subject(lang('please_complete_form'));
			});
		}catch(\Exception $ex){
			// pre('asd');
			Log::channel('reminderEmailError')->critical('Email sending failed for user:'.$formDetails->formOwner->name.'['.$formDetails->formOwner->id.']. Cause:'.$ex->getMessage(), $request->all());
			return response()->json(['status'=>false,'message'=>'Email sending failed']);
		}
		
		return response()->json(['status'=>true,'message'=>'Reminder Email Sent.']);
	}
	
	public function shortlist_application($formId, Request $request){
		
		if(!$request->ajax()){
			return redirect()->to(apa('registration/all-submission-list'))->with('errorMessage','Invalid Request');
		}
		
		$formDetails =  FormModel::where('form_id','=',$formId)
						->where('form_status','=',1)
						->first();
		
		
		
		if(empty($formDetails)){
			return redirect()->to(apa('registration/all-submission-list'))->with('errorMessage','Invalid Form Requested');
		}
		
		$newStatus = ($formDetails->shortlist_status == 1)?2:1;
		
		try{
			DB::beginTransaction();
			$data = [	
						'shortlist_status' => $newStatus,
						'shortlisted_by' => Auth::user()->id,
						'shortlisted_at' => date('Y-m-d H:i:s')
					];
			$form = FormModel::where('form_id','=',$formId)->first();
			$form->update($data);
			
			
			ShortlistModel::insert([
				'sh_form_id'=> $formId,
				'sh_user_id'=> Auth::user()->id,
				'sh_status'=> $newStatus,
				'sh_created_at'=> date('Y-m-d H:i:s')
			]);
			DB::commit();
		}catch(\Exception $ex){
			DB::rollBack();
			Log::channel('shortListError')->critical('Short List failed for user:'.$formDetails->formOwner->name.'['.$formDetails->formOwner->id.']. Cause:'.$ex->getMessage(), $request->all());
			return response()->json(['status'=>false,'message'=>'Operation failed!']);
		}
		
		$message = ($newStatus == 1)?'Application shortlisted.':'Application removed from shortlist';
		
		return response()->json(['status'=>true,'message'=>$message,'formStatus'=>$newStatus]);
	}
	public function contact_details(Request $request){
 	  

 	    $tmp= ContactModel::orderBy('contact_created_at','desc');


		if(!empty($request->filter_reg_name)){
			$tmp->where('contact_name','LIKE','%'.$request->filter_reg_name.'%');
		}
		
		if(!empty($request->filter_reg_email)){
			$tmp->where('contact_email',$request->filter_reg_email);
		}
		
		if(!empty($request->filter_reg_date_from)){
			$tmp->whereRaw('DATE(contact_created_at) >= "'.date('Y-m-d',strtotime($request->filter_reg_date_from)).'"');
		}
		
		if(!empty($request->filter_reg_date_to)){
			$tmp->whereRaw('DATE(contact_created_at) <= "'.date('Y-m-d',strtotime($request->filter_reg_date_to)).'"');
		}
		
		$this->data['contactUsDetails'] =$tmp->paginate(20);
	    return view('admin.contact.submission_list',$this->data);
    }

    public function contact_details_download(Request $request){
    	$export = new ContactRequestExport($request);
		return Excel::download($export, 'Contact Request '.date('Y-m-d').'.xlsx');

    }

	public function report_details(Request $request){
 	  

 	    $tmp= ReportModel::orderBy('report_created_at','desc');
		
		if(!empty($request->filter_reg_date_from)){
			$tmp->whereRaw('DATE(report_created_at) >= "'.date('Y-m-d',strtotime($request->filter_reg_date_from)).'"');
		}
		
		if(!empty($request->filter_reg_date_to)){
			$tmp->whereRaw('DATE(report_created_at) <= "'.date('Y-m-d',strtotime($request->filter_reg_date_to)).'"');
		}
		
		$this->data['reportDetails'] =$tmp->paginate(20);
	    return view('admin.contact.report_list',$this->data);
    }

    public function report_details_download(Request $request){
    	$export = new ReportRequestExport($request);
		return Excel::download($export, 'Report Request '.date('Y-m-d').'.xlsx');

    }    
	
}
