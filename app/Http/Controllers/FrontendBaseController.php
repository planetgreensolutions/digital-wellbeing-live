<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\Admodels\MenuManagerModel;
use App\Models\Admodels\CountryModel;
use App\Models\FrontendCmsModel as FrontendCmsModel;
use App\Models\ApplicationModel as AppModel;
use App\Models\Admodels\PostModel;
use App\Models\UserDataModel;
use App\Models\SettingModel;
use App\Http\Controllers\Session;
use Cookie;
use Config;
 use Carbon\Carbon; 
// use Carbon\Carbon; 
use View,
    File,
    Image;
use \Twitter;
use App\User as User;
use Jenssegers\Agent\Agent;

class FrontendBaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    use ValidatesRequests;

    protected $data;
    protected $breadCrumbs = array();
    protected $isBackendUser = false;
    protected $userInfo = false;
    protected $userType = 0;
    protected $userObj = false;
    
    public function __construct() {
        
        $request = request();
		
		// pre('asd');
          
        $this->data['currentURI'] = $request->fullUrl();
        $this->data['pageHasCaptcha'] = false;
        $this->middleware(function ($request, $next) {
           
            $config = \HTMLPurifier_Config::createDefault();
            
            $config->set("HTML.Allowed", "");
            
            $this->data['HTMLTextOnlyPurifier'] = new \HTMLPurifier($config);
            $this->data['agent'] = new Agent();
			
			$editorPurifyConfig = \Config::get('purifier');
			
			$this->data['contentPurifier'] = new \HTMLPurifier($editorPurifyConfig);
			
            $this->data['errorMessage'] = \Session::get('errorMessage');

            $this->data['message'] = \Session::get('message');
			
            $this->data['activationMessagee'] = \Session::get('activationMessagee');

            $this->data['homeMessage'] = \Session::get('homeMessage');

            $this->data['topMessage'] = \Session::get('topMessage');
            $this->data['userMessages'] = \Session::get('userMessages');
            $this->data['userMessage'] = \Session::get('userMessage');
            $this->data['monthNames'] =[ array(
                                                    'en'=>'January',
                                                    'ar'=>'?????',
                                                ),
                                                array(
                                                    'en'=>'February',
                                                    'ar'=>'??????',
                                                ),
                                                array(
                                                    'en'=>'March',
                                                    'ar'=>'????',
                                                ),
                                                array(
                                                    'en'=>'April',
                                                    'ar'=>'?????',
                                                ),
                                                array(
                                                    'en'=>'May',
                                                    'ar'=>'????',
                                                ),
                                                array(
                                                    'en'=>'June',
                                                    'ar'=>'?????',
                                                ),
                                                array(
                                                    'en'=>'July',
                                                    'ar'=>'?????',
                                                ),
                                                array(
                                                    'en'=>'August',
                                                    'ar'=>'?????',
                                                ),
                                                array(
                                                    'en'=>'September',
                                                    'ar'=>'??????',
                                                ),
                                                array(
                                                    'en'=>'October',
                                                    'ar'=>'??????',
                                                ),
                                                array(
                                                    'en'=>'November',
                                                    'ar'=>'??????',
                                                ),
                                                array(
                                                    'en'=>'December',
                                                    'ar'=>'??????',
                                                )
                                                
                                            ];
            $this->data['countries'] = DB::table('country')
										->where('country_status', 1)
										->orderBy('country_id','asc')
										->get();
            
            $this->data['emirateList'] = DB::table('uae_emirates')->get();
            
            $this->data['userObj'] = null;
            $this->data['isHomePage'] = false;            
			if(Auth::user()){
					$this->data['userObj'] = Auth::user();
					$this->userInfo = \Auth::user();
					$this->user = \Auth::user();
					
			}
			
            return $next($request);
        });
       
        $this->data['pageTitle'] = '';
        $this->data['current_menu'] = '';
        $this->data['current_page_slug'] = '';
        $this->data['topParentAlias'] = '';
        $this->parentMenuLevel = 0;
        $this->data['breadCrumbs'] = '';

        $this->data['currentURL'] = $request->fullUrl();
		$this->data['ageLimitForReg'] = 35; 
		$this->data['max_allowed_slot_for_user'] = 6; 
		$this->data['max_allowed_slot_for_org'] = 8; 
        $this->data['bodyClass'] = '';
		$this->get_website_settings();
        $this->set_multi_language();
		
        
        $this->data['menuTopHTML'] = MenuManagerModel::getFrontendTopMenuUL($request, false);
        $this->data['menuHTML'] = MenuManagerModel::getFrontendMenuUL($request);
        $this->data['menuMobileHTML'] = MenuManagerModel::getFrontendMenuMobile($request);
		
    }
    

   
    protected function starts_with($haystack, $needle) {
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }

    protected function ends_with($haystack, $needle) {
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
    }

    protected function buildTree($elements, $parentId = 0,$parentSlug=null) {
        $branch = array();
		$level = 0;
        foreach ($elements as $element) {
            if ($element->page_parent_id == $parentId) {
				$element->childrens = [];
                $children = $this->buildTree($elements, $element->page_id,$element->page_slug);
                if ($children) {
                    $element->childrens = $children;
                }
                $element->visibleChildrens = 0;
                $element->parentSlug = $parentSlug;
                if (isset($element->childrens)) {
                    $visibleChilds = 0;
                    foreach ($element->childrens as $child) {
                        if ($child->page_is_main_navigation == 1) {
							
                            $element->visibleChildrens++;
                        }
                    }
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    protected function get_validator_messages($validator) {
        $messages = $validator->messages();
        $str = '<ul class="validation_errors">';
        foreach ($messages->all('<li>:message</li>') as $message) {
            $str .= $message;
        }
        $str .= '</ul>';
        $this->data['messages'] = $this->custom_message($str, 'error');
    }

    protected function get_website_settings() {
        $this->data['admin_settings'] = $this->data['websiteSettings'] = SettingModel::find(1);
        $this->data['pageTitle'] = '';
    }

   

    public function set_multi_language() {
        
        $lang = null;
        
        $reqLang = request()->segment(1);
        
        if (in_array($reqLang, array('en', 'ar'))) { //If present in URL it has the highest priority
            $lang = $reqLang;
        }else if(empty($lang) && session()->has('lang')){ //If not in URL check in session
            $lang = session()->get('lang');
        }else{
            $lang = $this->data['websiteSettings']->default_lang;
        }
        $this->data['lang'] = $lang;
		session()->put('lang',$lang);
        \App::setLocale($lang);
        
    }

    protected function send_mail($settings, $data, $attachment = null, $template = 'email_template.email_message_contact') {
        \Mail::send($template, $data, function($message) use ($settings) {
			if(!empty($settings['from'])){
				$message->from($settings['from']);
			}
            $message->to($settings['to'])->subject($settings['subject']); //->cc('bar@example.com');
            if (!empty($settings['attachment'])) {
                $message->attach($settings['attachment']);
            }
        });
    }
    
    
    
    public function store_file($controlName, $path) {
        $file = request()->file($controlName);
        if (!$file)
        return false;
        $fileName = $file->hashName();
        $fileNameWithPath = $file->store($path);
        return array($fileName, $fileNameWithPath);
    }

    protected function upload_multiple_files($controlName, $destinationPath) {
        if (empty($destinationPath))
            return false;
        if (empty($controlName))
            return false;
        if (!Request::hasFile($controlName))
            return false; // check whether file is uploaded
            
        $files = Input::file($controlName);
        $result = array();

        foreach ($files as $file) {
            if (!empty($file)) {
                $extension = $file->getClientOriginalExtension();
                $filename = md5(microtime() . rand() . "-" . $file->getClientOriginalName()) . '.' . $extension;
                $imageUpload = $file->move($destinationPath, $filename);
                $result[] = $filename;
            }
        }
        return $result;
    }
		

	protected function resize_image($fileName,$filePath,$dimensions=array(),$crop=false,$oldFileName=''){

		if(empty($fileName)) return false;
		if(empty($filePath)) return false;
		try{
		$sourcePath = './storage/app/'.$filePath.DIRECTORY_SEPARATOR;
			$sourceImage = $sourcePath.$fileName;
			if(!empty($dimensions)){
				foreach($dimensions as $key=>$dim){
					if (!File::isDirectory($sourcePath.'/'.$key."/")){
						File::makeDirectory($sourcePath.'/'.$key);
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

    protected function resize_and_crop_image($request, $controlName, $destinationPath, $dimensions = array(), $oldFileName = '') {

        if (empty($destinationPath))
            return false;
        if (empty($controlName))
            return false;

        if (!$request->file($controlName)->isValid())
            return false; // chek whether file is valid`

        $destinationPath = 'storage/app/' . $destinationPath;

        $file = Input::file($controlName);

        $extension = $file->getClientOriginalExtension();
        $filename = md5(microtime()) . '.' . $extension;
        $imageUpload = Input::file($controlName)->move($destinationPath, $filename);

        $sourceImage = $destinationPath . DIRECTORY_SEPARATOR . $filename;

        if (!empty($dimensions)) {
            foreach ($dimensions as $dim) {
                if (!File::isDirectory($destinationPath . '/' . $dim['folder'] . "/")) {
                    File::makeDirectory($destinationPath . '/' . $dim['folder']);
                }

                Image::make($sourceImage)
                        ->fit($dim['width'], $dim['height'])
                        ->save($destinationPath . '/' . $dim['folder'] . '/' . $filename)
                        ->destroy();
            }
        }
        if (!empty($oldFileName) && File::exists($destinationPath . '/' . $oldFileName)) {
            File::delete($destinationPath . '/' . $oldFileName);
            if (!empty($dimensions)) {
                foreach ($dimensions as $dim) {
                    File::delete($destinationPath . '/' . $dim['folder'] . '/' . $oldFileName);
                }
            }
        }

        return $filename;
    }

    protected function create_breadcrumbs() {
        // if(empty($this->breadCrumbs)) return;
        $this->data['breadCrumbs'] = '';
        $temp = array_reverse($this->breadCrumbs);
        $this->data['breadCrumbs'] .= '<ol class="breadcrumb">';
        // $this->data['breadCrumbs'] .= '<li><a href="'.asset('/'.$this->data['lang']).'" class="homebrc">'.(($this->data['lang']=='en')?'Home':'?????? ????????').'</a> <span class="brc-expand">/</span></li>';
        $this->data['breadCrumbs'] .= '<li><a href="' . asset('/' . $this->data['lang']) . '" class="homebrc">' . (($this->data['lang'] == 'en') ? 'Home' : '?????? ????????') . '</a></li>';
        $count = count($temp);
        $counter = 0;
        // echo '<pre>';
        // print_r($temp);
       // exit();
        foreach ($temp as $breadC) {
            if ($counter < ($count - 1)) {
                $pageURL = asset($this->data['lang'] . "/" . $breadC['pageAlias']);
                // $this->data['breadCrumbs'] .= '<li><a class="read1" href="'.$pageURL.'">'.(($this->data['lang']=='en')?$breadC['pageName']:$breadC['pageNameArabic']).'</a> <span class="brc-expand">/</span></li>';
                $this->data['breadCrumbs'] .= '<li><a class="read1" href="' . $pageURL . '">' . (($this->data['lang'] == 'en') ? $breadC['pageName'] : $breadC['pageNameArabic']) . '</a> </li>';
            } else {
                $this->data['breadCrumbs'] .= '<li class="current">' . (($this->data['lang'] == 'en') ? $breadC['pageName'] : $breadC['pageNameArabic']) . '</li>';
            }
            $counter++;
        }
        $this->data['breadCrumbs'] .= '</ol>';
    }

    protected function send_curl($url) {
        // create curl resource
        $ch = curl_init();
        // set url
        curl_setopt($ch, CURLOPT_URL, $url);
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // $output contains the output string
        $output = curl_exec($ch);
        // close curl resource to free up system resources
        curl_close($ch);
        return $output;
    }

    protected function get_youtube_id($url) {
        $videoID = false;
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
            $videoID = $id[1];
        } else if (preg_match('/youtube\.com\/watch\?.*&v=([^\&\?\/]+)/', $url, $id)) {
            $mediaID = $id[1];
        } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
            $videoID = $id[1];
        } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
            $videoID = $id[1];
        } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
            $videoID = $id[1];
        } else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
            $videoID = $id[1];
        }
        return $videoID;
    }

    
    protected function get_elapsed_date_in_day_hour_and_minutes($expDate) {
        $timeFirst = strtotime($expDate);
        $timeSecond = strtotime(date('Y-m-d H:i:s'));
        $differenceInSeconds = $timeSecond - $timeFirst;
        if ($timeSecond > $timeFirst) {
            return false;
        }
        $inputSeconds = $timeFirst - $timeSecond;
        // echo $inputSeconds; exit();
        $secondsInAMinute = 60;
        $secondsInAnHour = 60 * $secondsInAMinute;
        $secondsInADay = 24 * $secondsInAnHour;
        // extract days
        $days = floor($inputSeconds / $secondsInADay);
        // extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);
        // extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);
        // extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);
        // return the final array
        $obj = array(
            'days' => (int) str_pad($days, 2, '0', STR_PAD_LEFT),
            'hours' => (int) str_pad($hours, 2, '0', STR_PAD_LEFT),
            'minutes' => (int) str_pad($minutes, 2, '0', STR_PAD_LEFT),
            'seconds' => (int) str_pad($seconds, 2, '0', STR_PAD_LEFT),
        );
        return $obj;
        // return array('months'=> str_pad($elapsedDays,2,'0',STR_PAD_LEFT),'weeks'=> str_pad($elapsedWeeks,2,'0',STR_PAD_LEFT),'days'=> str_pad($elapsedDays,2,'0',STR_PAD_LEFT));
    }

    protected function get_elapsed_date_in_month_week_and_days($expDate) {
        $expiryDate = new DateTime($expDate);
        $currentDate = new DateTime(date('Y-m-d'));
        if ($currentDate > $expiryDate) {
            return false;
        }
        $elapsedMonth = $currentDate->diff($expiryDate)->m;
        $balanceDays = $currentDate->diff($expiryDate)->d;
        $elapsedDays = $balanceDays % 7;
        $elapsedWeeks = floor($balanceDays / 7);
        return array('months' => str_pad($elapsedMonth, 2, '0', STR_PAD_LEFT), 'weeks' => str_pad($elapsedWeeks, 2, '0', STR_PAD_LEFT), 'days' => str_pad($elapsedDays, 2, '0', STR_PAD_LEFT));
    }

    

    /* protected function get_front_end_menus() {
        $pageList = MenuManagerModel::getFrontendMenus(true);
        $allPages = $this->buildTree($pageList);
        return $allPages;
    }

    protected function get_front_end_categories() {
        $pageList = MenuManagerModel::where('page_status', '=', 1)->where('is_home_display', '=', 1)->orderBy('page_priority', 'asc')->get();
        $allPages = $this->buildTree($pageList);
        return $allPages;
    }
  
    protected function get_mobile_menu() {
        $pageList = MenuManagerModel::where('page_status', '=', 1)->where('page_is_hide_mobile', '=', 2)->orderBy('page_priority', 'asc')->get();
       // $allPages = $this->buildTree($pageList);
	  
        return $pageList;
    }
     */
    protected function get_tweets($count = '') {
        $totalTweets = array();
        $twitterID = 'nouphaltklm';
        $lastUpdated = $this->data['websiteSettings']->tweet_last_updated;
        if (!empty($lastUpdated) && ( ( time() - strtotime($lastUpdated) ) < 3600 )) { // updated before one hour
            $tweets = DB::table('tweets_master')->get();
            if (!empty($tweets) && count($tweets) > 2) {
                // echo 'asdad'; exit();
                $tt = 0;
                foreach ($tweets as $twt) {
                    $totalTweets[$tt]['tweet'] = '<div class="tweet lang_' . $twt->lang . '"><h3 class="tweetScreenname"><a href="#" target="_blank">@' . $twt->screen_name . '</a></h3><p><a href="https://twitter.com/' . $twt->screen_name . '/status/' . $twt->id_str . '" target="_blank">' . $twt->tweet_text . ' </a></p></div>';
                    $totalTweets[$tt]['profilePic'] = $twt->profile_image_url;
                    $tt++;
                }
                // die('asd');
                return $totalTweets;
            }
        }
        $totalTweets['tweetList'] = Twitter::getUserTimeline(['screen_name' => 'EFICA_AWARDS', 'count' => 20, 'format' => 'json']);
        $finalTweets = array();
        if (!empty($totalTweets['tweetList']->errors)) {
            return $finalTweets;
        }
        $totalTweets['tweetList'] = json_decode($totalTweets['tweetList']);
        $tweetArr = array();
        for ($k = 0, $j = count($totalTweets['tweetList']); $k < $j; $k++) {
            $curTweet = $totalTweets['tweetList'][$k];
            $finalTweets[$k]['tweet'] = '<div class="tweet lang_' . $curTweet->lang . '"><h3 class="tweetScreenname"><a href="#">@' . $curTweet->user->screen_name . '</a></h3><p><a href="https://twitter.com/' . $curTweet->user->screen_name . '/status/' . $curTweet->id_str . '" target="_blank">' . $curTweet->text . ' </a></p></div>';
            $finalTweets[$k]['profilePic'] = $curTweet->user->profile_image_url;
            $tweetArr[] = array(
                'lang' => $curTweet->lang,
                'id_str' => $curTweet->id_str,
                'screen_name' => $curTweet->user->screen_name,
                'tweet_text' => $curTweet->text,
                'profile_image_url' => $curTweet->user->profile_image_url,
                'created_at' => date('Y-m-d H:i:s', strtotime($curTweet->created_at)),
            );
        }
        if (!empty($tweetArr)) {
            DB::table('tweets_master')->delete();
            DB::table('tweets_master')->insert($tweetArr);
            DB::table('setting')->where('id', '=', 1)->update(array('tweet_last_updated' => date('Y-m-d h:i:s')));
        }
        return $finalTweets;
    }

    protected function getAllData() {
        return $this->data;
    }

   

    protected function is_rtl($string) {
        $rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
        return preg_match($rtl_chars_pattern, $string);
    }

    protected function createUserMessageUL($errorMessageObject, $addClass = array()) {
        $mesg = '<ul>';

        if ($addClass) {
            $mesg = '<ul class="' . $addClass['class'] . '">';
        }
        if (is_object($errorMessageObject)) {
            foreach ($errorMessageObject->all() as $message) {

                $mesg .= '<li>' . $message . '</li>';
            }
        } else {
            $mesg .= '<li>' . $errorMessageObject . '</li>';
        }
        $mesg .= '</ul>';
        return $mesg;
    }

    protected function highlight_text($text, $keyword) {
        return preg_replace("/\p{L}*?" . preg_quote($keyword) . "\p{L}*/ui", "<b>$0</b>", $text);
    }
	
	public function _callCURL($url,$request,$additionalParams,$jsonDecode = true){
		
		$client = new \GuzzleHttp\Client();
		
		$params = [
			'api_key'=> \Config::get('app.api_key'),
			'api_secret'=> \Config::get('app.api_secret'),
			'request_ip'=> $request->server('LOCAL_ADDR'),
            'request_ip'=> "192.168.1.134",
			'request_domain'=> \Config::get('app.request_domain'),
		];

        
		$params = array_merge($params,$additionalParams);

		$paramString='';
		foreach($params as $key=>$param){
			if(empty($paramString)){
				$paramString = $key.'='.$param;
			}else{
				$paramString .= '&'.$key.'='.$param;
			}
		}
		
		$res = $client->get($url.'?'.$paramString);
		if($jsonDecode){
			return json_decode($res->getBody());
		}
		return $res->getBody();
		
	}
	
	protected function custom_message($message,$type='error'){
		 if($type=='success'){
		 $message = '<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i>
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><b>'.$message.'</b></div>';
		 }elseif($type=='error'){
		  $message = '<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i>
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><b>'.$message.'</b></div>';
		 }
		 return $message;
	}
	
   
   
    
	protected function get_instagram_feed($pagename){
		$cache = new \Instagram\Storage\CacheManager(storage_path('app/public/uploads/cache'));
		$api   = new \Instagram\Api($cache);
		$api->setUserName($pagename);

		$feed = $api->getFeed();
		
		return $feed;
	}
    
    protected function _sanitizeVariable($var){
        
        return strip_tags($var);
        
    }
	
	protected function _GetCategoryNestableConfig(){
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
				'label' => 'name',
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
