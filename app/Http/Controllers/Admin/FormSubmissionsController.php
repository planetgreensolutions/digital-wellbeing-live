<?php
namespace App\Http\Controllers\Admin;

use App\Exports\CharterPledgeExport;
use App\Http\Controllers\Admin\Base\AdminBaseController;
use App\Models\Admodels\CharterPledgeRegistrationModel;
use App\Models\Admodels\CountryModel;
use App\Models\Admodels\PostModel;
use Auth;
use Config;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Input;
use Maatwebsite\Excel\Facades\Excel;

class FormSubmissionsController extends AdminBaseController {
	protected $roleNames;
	public function __construct(Request $request) {

		parent::__construct($request);
	}
	/**
	 * list all registration with email id
	 *@param Request $request
	 *
	 *@return View
	 */
	public function index(Request $request) {

		switch ($request->formType) {
		case "charter-pledge-registrations":
			$page = "admin.charter-pledge-registrations.list";
			// $this->data['submissionList'] = CharterPledgeRegistrationModel::orderBy('created_at', 'desc');
			$this->data['submissionList'] = CharterPledgeRegistrationModel::when(request()->input('cpr_name'), function ($q) {
				return $q->where('cpr_name', 'LIKE', '%' . request()->input('cpr_name') . '%');
			})
				->when(request()->input('cpr_email_address'), function ($q) {
					return $q->where('cpr_email_address', '=', request()->input('cpr_email_address'));
				})
				->when(request()->input('cpr_nationality'), function ($q) {
					return $q->where('cpr_nationality', '=', request()->input('cpr_nationality'));
				})
				->when(request()->input('cpr_age_range'), function ($q) {
					$range = request()->input('cpr_age_range');
					$query = "";

					switch ($range) {
					case '0-16':
						$query = 'cpr_age > 0 AND cpr_age < 17';
						break;

					case '16-25':
						$query = 'cpr_age > 15 AND cpr_age < 26';
						break;

					case '26-40':
						$query = 'cpr_age > 25 AND cpr_age < 41';
						break;

					case '40-60':
						$query = 'cpr_age > 39 AND cpr_age < 61';
						break;

					case '60+':
						$query = 'cpr_age > 60';
						break;
					}

					return $q->whereRaw($query);
				})
				->when(request()->input('from_date'), function ($q) {
					return $q->where('created_at', '>=', date('Y-m-d', strtotime(request()->input('from_date'))));
				})
				->when(request()->input('to_date'), function ($q) {
					return $q->where('created_at', '<=', date('Y-m-d', strtotime(request()->input('to_date'))));
				})
				->orderBy('created_at', 'desc');

			$this->data['countries'] = CountryModel::orderByRaw('(country_id = 221) DESC')->get();
			break;

		default:
			break;
		}

		$this->data['submissionList'] = $this->data['submissionList']->paginate(20)
			->appends(request()->except('page'));

		return view($page, $this->data);
	}

	// public function details (Request $request,$id){
	// 	// if(!$this->checkPermission('View')){
	// 	// 	return $this->returnInvalidPermission($request);
	// 	// }

	// 	$this->data['registrant'] = RegistrationsModel::where('reg_id', $id)->first();

	// 	if(empty($this->data['registrant'])){
	// 		$msg = '<div class="alert alert-danger">Registrant Not found</div>';
	// 		return redirect()->to(apa('registrations/arabs-to-mars-registration',true))->with('userMessage',$msg);
	// 	}

	// 	return view('admin.arabs-to-mars-registration.details',$this->data);
	// }
	/**
	 * list individual registration with email id
	 *@param Request $request
	 *
	 *@return View
	 */

	// public function details($id,Request $request){
	// 	$this->data['hf_details'] = HackathonFormModel::where('hf_id',$id)->first();
	// 	return view('admin.hackathon-submissions.details',$this->data);
	// }

	/**
	 * Download all subscription list as excel format
	 *@param Request $request
	 *
	 *@return Excel sheet
	 */
	public function download(Request $request) {
		ini_set('memory_limit', '2048M');
		ini_set('max_execution_time', '3500');
		switch ($request->formType) {
		case "charter-pledge-registrations":
			$export = new CharterPledgeExport($request);
			$filename = "CharterPledgeRegistrations-" . date('Y-m-d') . ".xlsx";
			break;

		default:
			break;
		}

		return Excel::download($export, $filename);
	}
}
