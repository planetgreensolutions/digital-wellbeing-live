<?php
namespace App\Http\Controllers;

use App\Models\Admodels\ContactModel;
use App\Models\Admodels\ReportModel;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Input;
use Lang;
use Response;

class ContactController extends FrontendBaseController
{

    protected $layout = 'frontend.layouts.master';

    private $ajaxData = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function index($lang, Request $request)
    {
        if ($request->ajax()) {
            if ($request->input('_token')) {
                $inputs = array(
                    'contact_name' => $this->_sanitizeVariable($request->input('name')),
                    'contact_email' => $this->_sanitizeVariable($request->input('email')),
                    'contact_phone' => $this->_sanitizeVariable($request->input('phone_number')),
                    'contact_subject' => $this->_sanitizeVariable($request->input('subject')),
                    'contact_message' => $this->_sanitizeVariable($request->input('message')),
                    'captcha' => $request->input('g-recaptcha-response'),
                );
                $rules = array(
                    'contact_name' => 'required|max:150',
                    'contact_email' => 'required|email',
                    'contact_phone' => 'required|numeric|min:9',
                    'contact_message' => 'required|max:900',
                    'contact_subject' => 'required',
                    //'captcha' => 'required|recaptcha',
                    'captcha' => 'required',
                );
                $messages = array(
                    'contact_name.required' => Lang::get('messages.contact_name_required'),
                    'contact_name.max' => Lang::get('messages.contact_name_max_length_150_characters'),
                    'contact_name.regex' => Lang::get('messages.special_charactors_not_allowed_in_name'),
                    'contact_email.required' => Lang::get('messages.contact_email_required'),
                    'contact_phone.required' => Lang::get('messages.phone_number_required'),
                    'contact_phone.min' => Lang::get('messages.mob_no_min_length'),
                    'contact_phone.numeric' => Lang::get('messages.invalid_phone_number'),
                    'contact_message.required' => Lang::get('messages.contact_message_required'),
                    'contact_message.max' => Lang::get('messages.contact_message_maxlength_900_characters'),
                    'contact_message.regex' => Lang::get('messages.special_charactors_not_allowed_in_message_box'),
                );
                $validator = \Validator::make($inputs, $rules, $messages);
                if ($validator->fails()) {
                    Input::flash();
                    $messages = $validator->messages();
                    $userMessage = '';
                    $messages = $validator->messages();
                    foreach ($messages->all() as $message) {

                        $userMessage .= '' . $message . ', ';
                    }
                    $userMessage .= '';
                    return \Response::json(array('status' => false, 'title' => 'Error', 'message' => $userMessage));
                } else {
                    try {

                        \DB::beginTransaction();

                        $data = array(
                            'contact_name' => strip_tags($request->input('name')),
                            'contact_email' => strip_tags($request->input('email')),
                            'contact_phone' => strip_tags($request->input('phone_number')),
                            'contact_subject' => strip_tags($request->input('subject')),
                            'contact_message' => strip_tags($request->input('message')),
                        );
                        ContactModel::create($data);
                        //Auto reply
                        $mailData = array();
                        $settings = array();
                        $settings['subject'] = Lang::get('messages.thank_you_for_contacting_subject');
                        $settings['to'] = $data['contact_email'];
                        $mailData['contact_name'] = $inputs['contact_name'];
                        $template_info = 'frontend.email_template.contact_request_en';
                        $emailEnquirey = explode(',', trim($this->data['websiteSettings']->enquiry_send_email));

                        $template = 'frontend.email_template.autoreply_contact_us_en';
                        if ($this->data['lang'] == 'ar') {
                            $template = 'frontend.email_template.autoreply_contact_us_ar';
                        }

                        try {
                            \Mail::send($template, $mailData, function ($message) use ($settings) {
                                $message->to($settings['to'])->subject($settings['subject']);
                            });
                            //mail to admin
                            \Mail::send($template_info, $data, function ($message) use ($emailEnquirey) {
                                $message->to($emailEnquirey)
                                    ->subject("Contact Request");
                            });
                        } catch (\Exception $ex) {
                        }

                        \DB::commit();

                    } catch (\Exception $ex) {
                        \DB::rollBack();

                        $usertitle = Lang::get('messages.error');

                        $userMessage = Lang::get('messages.unable_to_register_please_contact');

                        return \Response::json(array('status' => false, 'title' => $usertitle, 'message' => $userMessage));
                    }

                    $usertitle = Lang::get('messages.thank_you');

                    $userMessage = Lang::get('messages.thank_you_for_contacting');

                    return \Response::json(array('status' => true, 'title' => $usertitle, 'message' => $userMessage));
                }
            }

        } else {
            return view('frontend.contact', $this->data);
        }

    }

    public function report($lang, Request $request)
    {
        if ($request->ajax()) {
            if ($request->input('_token')) {
                $inputs = array(
                    //'report_name' => $this->_sanitizeVariable($request->input('report_name')),
                    //'report_email' => $this->_sanitizeVariable($request->input('report_email')),
                    'report_by' => $this->_sanitizeVariable($request->input('report_by')),
                    'report_message' => $this->_sanitizeVariable($request->input('report_message')),
                    //'captcha' => $request->input('g-recaptcha-response')
                );
                $rules = array(

                    //'contact_email' => 'required|email',
                    //'contact_email' => 'required|email',
                    'report_by' => 'required',
                    'report_message' => 'required|max:900',
                    //'captcha' => 'required|recaptcha',
                    //'captcha' => 'required',
                );
                $messages = array(

                    //'contact_name.max' => Lang::get('messages.contact_name_max_length_150_characters'),
                    //'contact_name.regex' => Lang::get('messages.special_charactors_not_allowed_in_name'),
                    //'contact_email.required' => Lang::get('messages.contact_email_required'),
                    'report_message.required' => Lang::get('messages.contact_message_required'),
                    'report_message.max' => Lang::get('messages.contact_message_maxlength_900_characters'),
                    'report_message.regex' => Lang::get('messages.special_charactors_not_allowed_in_message_box'),

                );
                $validator = \Validator::make($inputs, $rules, $messages);
                if ($validator->fails()) {
                    Input::flash();
                    $messages = $validator->messages();
                    $userMessage = '';
                    $messages = $validator->messages();
                    foreach ($messages->all() as $message) {

                        $userMessage .= '' . $message . ', ';
                    }
                    $userMessage .= '';
                    return \Response::json(array('status' => false, 'title' => 'Error', 'message' => $userMessage));
                } else {
                    try {

                        \DB::beginTransaction();

                        $data = array(
                            'report_by' => strip_tags($request->input('report_by')),
                            'report_message' => strip_tags($request->input('report_message')),
                            'report_data' => json_encode($request->input('report_data')),
                        );
                        ReportModel::create($data);

                        \DB::commit();

                    } catch (\Exception $ex) {
                        \DB::rollBack();

                        $usertitle = Lang::get('messages.error');
                        $userMessage = Lang::get('messages.unable_to_register_please_contact');

                        return \Response::json(array('status' => false, 'title' => $usertitle, 'message' => $userMessage));
                    }

                    /*
                    //Auto reply
                    $mailData = array();
                    $settings = array();
                    $settings['subject'] = Lang::get('messages.thank_you_for_contacting_subject');
                    $settings['to'] = $data['contact_email'];
                    $mailData['contact_name'] = $inputs['contact_name'] ;
                    $template_info = 'frontend.email_template.contact_request_en';
                    $emailEnquirey=explode(',',trim($this->data['websiteSettings']->enquiry_send_email));

                    $template = 'frontend.email_template.autoreply_contact_us_en';
                    if($this->data['lang']=='ar'){
                    $template  = 'frontend.email_template.autoreply_contact_us_ar';
                    }

                    try{
                    \Mail::send($template, $mailData , function($message) use ($settings){
                    $message->to($settings['to'])->subject($settings['subject']);
                    });
                    //mail to admin
                    \Mail::send($template_info,$data,function($message) use ( $emailEnquirey ){
                    $message->to($emailEnquirey)
                    ->subject("Contact Request");
                    });
                    }catch (\Exception $ex){
                    }

                     */

                    $usertitle = Lang::get('messages.thank_you');
                    $userMessage = Lang::get('messages.thank_you_for_contacting');

                    return \Response::json(array('status' => true, 'title' => $usertitle, 'message' => $userMessage));
                }
            }

        }
    }

}
