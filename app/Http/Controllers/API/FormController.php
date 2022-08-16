<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Admodels\CharterPledgeRegistrationModel;
use App\Traits\LoggerTrait;
use Browser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Lang;

/**
 *--------------------------------------------------------------------------
 * Form Controller
 *--------------------------------------------------------------------------
 *
 * This controller handles user inputs from AYC Form form and saves it to database
 * it has a protected variable called $inputs which holds the POST data that is sent by the client
 *
 *
 */
class FormController extends Controller {
	use LoggerTrait;
	protected $inputs = [];

	/**
	 * Accept Graduate input and Save it to database
	 * @param string $lang
	 * @param  object  $request
	 * @return string
	 */
	public function saveFormRequest($lang, Request $request) {
		\App::setLocale($lang);

		$userResponse = ['status' => false];

		switch ($request->formType) {
		case "charter-pledge":
			$validator = $this->validatePledgeRequest($request);
			break;

		default:
			break;
		}

		try {
			if ($validator->fails()) {
				$errorString = $this->getValidationErrors($validator);
				$userResponse['title'] = trans('messages.error');
				$userResponse['message'] = $errorString;
			} else {

				// if($request->formType != "contact"){
				unset($this->inputs['captcha']);
				$clientData = [
					'ip' => (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : request()->ip(),
					'browser' => $result = Browser::detect(),
				];

				$this->inputs['user_agent_string'] = json_encode($clientData);
				$this->inputs['cpr_lang'] = \App::getLocale();
				$this->inputs['cpr_hash'] = (string) Str::uuid();

				// }

				$this->logRequest();

				switch ($request->formType) {
				case "charter-pledge":
					$newRecord = CharterPledgeRegistrationModel::create($this->inputs);
					$message_title = trans('messages.thank_you_for_contacting');
					break;

				default:
					break;
				}

				$this->sendMail($request);

				$userResponse = ['status' => true];
				$userResponse['title'] = trans('messages.success');
				$userResponse['message'] = $message_title;
			}
		} catch (\Exception $ex) {
			// $userResponse['title'] = trans('messages.error');
			$userResponse['message'] = $ex->getMessage();
			// $userResponse['message'] = trans('messages.server_error_contact_support');
			if ($ex->getCode() == 23000) {
				$userResponse['message'] = trans('messages.email_already_registered');
			}
		}

		return response()->json($userResponse);
	}

	/**
	 * Accept request bag and send Mail
	 *
	 * @param  object  $request
	 * @return null;
	 */
	private function sendMail($request) {
		try {
			$mailData = array();
			$settings = array();
			$toAddress = "";
			$template = "";
			$this->data['lang'] = \App::getLocale();

			switch ($request->formType) {
			case "charter-pledge":
				$toAddress = $this->inputs['cpr_email_address'];
				$mailData['contact_name'] = $this->inputs['cpr_name'];
				$subject = ($this->data['lang'] == 'en') ? "Positive Digital Citizen Certificate" : "شهادة المواطن الرقمي الإيجابي";
				$template = 'frontend.email_template.autoreply_charter_pledge_' . $this->data['lang'];
				break;

			default:
				break;
			}

			$pdfTemplate = 'frontend.certificate_templates.charter_pledge_certificate_' . $this->data['lang'];
			$pdfFilePath = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'charter_certificates' . DIRECTORY_SEPARATOR . $this->inputs['cpr_hash'] . '.pdf');

			$settings['to'] = $toAddress;
			$settings['subject'] = $subject;

			$pdf = \PDF::loadView($pdfTemplate, $mailData, [], [
				'mode' => 'utf-8',
				'format' => [291, 175],
				'setAutoTopMargin' => 'stretch',
				'autoMarginPadding' => 0,
				'bleedMargin' => 0,
				'crossMarkMargin' => 0,
				'cropMarkMargin' => 0,
				'nonPrintMargin' => 0,
				'margBuffer' => 0,
				'collapseBlockMargins' => false,
			]);

			$settings['pdfOutput'] = $pdf->output();
			$savePdf = $pdf->save($pdfFilePath);

			// $this->data['websiteSettings'] = DB::table('setting')->first();

			// mail to user
			\Mail::send($template, $mailData, function ($message) use ($settings) {
				$message->to($settings['to'])
					->subject($settings['subject'])
					->attachData($settings['pdfOutput'], "Your Certificate.pdf");
			});

		} catch (\Exception $ex) {
			pre($ex->getMessage());
		}
	}

	protected function _sanitizeVariable($var) {
		return strip_tags($var);
	}

	// Validate contact
	private function validatePledgeRequest($request) {
		$this->inputs = [
			'cpr_name' => $this->_sanitizeVariable($request->input('cpr_name')),
			'cpr_email_address' => $this->_sanitizeVariable($request->input('cpr_email_address')),
			'cpr_email_address_confirmation' => $this->_sanitizeVariable($request->input('cpr_email_address_confirmation')),
			'cpr_age' => $this->_sanitizeVariable($request->input('cpr_age')),
			'cpr_nationality' => $this->_sanitizeVariable($request->input('cpr_nationality')),
			'captcha' => $request->input('g-recaptcha-response'),
		];

		$this->rules = [
			'cpr_name' => 'required|max:255',
			'cpr_email_address' => 'required|confirmed|unique:charter_pledge_registration',
			'cpr_email_address_confirmation' => 'required',
			'cpr_age' => 'required',
			'cpr_nationality' => 'required',
			'captcha' => 'required|captcha',
		];

		$this->messages = [
			'cpr_name.required' => trans('messages.cp_name') . ' ' . trans('messages.field_required'),
			'cpr_name.max' => trans('messages.cp_name') . ' ' . trans('messages.max_x_characters', ['x' => '255']),
			'cpr_email_address.required' => trans('messages.email_address') . ' ' . trans('messages.field_required'),
			'cpr_email_address.unique' => trans('messages.email_exists'),
			'cpr_email_address.confirmed' => trans('messages.confirm_email_address'),
			'cpr_email_address_confirmation.required' => trans('messages.confirm_email_address') . ' ' . trans('messages.field_required'),
			'cpr_age.required' => trans('messages.age') . ' ' . trans('messages.field_required'),
			'cpr_nationality.requird' => trans('messages.nationality') . ' ' . trans('messages.field_required'),
		];

		$this->messages['captcha.required'] = trans('messages.captcha_required');
		$this->messages["captcha.captcha"] = trans('messages.invalid_captcha');

		$validator = \Validator::make($this->inputs, $this->rules, $this->messages);
		return $validator;
	}

	/**
	 * Get formatted validation error string
	 *
	 * @param  object  $validator
	 * @return string;
	 */
	private function getValidationErrors($validator) {
		$allMessages = ($validator->messages()->all());
		$requiredPrinted = false;
		$userMessage = '';

		foreach ($allMessages as $key => $messageTxt) {
			$userMessage .= $messageTxt;
		}

		return $userMessage;
	}

	/**
	 * Get validation error array
	 *
	 * @param  object  $validator
	 * @return array;
	 */
	private function getValidationErrorArray($validator) {
		$messages = $validator->messages();
		return $messages->all();
	}
}
