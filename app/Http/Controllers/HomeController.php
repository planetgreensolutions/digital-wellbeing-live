<?php

namespace App\Http\Controllers;

use App\Models\Admodels\CharterPledgeRegistrationModel;
use App\Models\Admodels\PostMediaModel;
use App\Models\Admodels\PostModel;
use App\Models\CategoryModel;
use App\User as User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends FrontendBaseController {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		$this->middleware(function ($request, $next) {

			$this->user = Auth::user();
			return $next($request);
		});
	}

	public function index(Request $request) {

		$lang = $this->data['lang'];

		$this->data['bodyClass'] = ' ';

		$this->data['isHomePage'] = true;
		$this->data['pageTitle'] .= 'Home';
		$this->data['homePage'] = true;
		$this->data['current_menu'] = 'home';
		$this->data['current_page_slug'] = 'home';
		$this->data['current_parent_menu'] = 'home';
		$this->data['topParentAlias'] = 'home';

		$this->data['home_page_title'] = $this->data['websiteSettings']->getData('home_page_title');
		$this->data['bannerList'] = PostModel::with(['bannerPost', 'meta'])->where('post_type', '=', 'banners')->active()->orderBy('post_priority', 'ASC')->get();

		$this->data['digitalDomainList'] = PostModel::where('post_type', '=', 'digital_domains')->active()->orderBy('post_priority', 'ASC')->get();
		$this->data['digitalWellbeing'] = PostModel::where('post_type', '=', 'about_digital_wellbeing')->active()->first();
		$this->data['digitalCitizenship'] = PostModel::where('post_type', '=', 'digital_citizenship')->active()->first();
		$this->data['sannif_online'] = PostModel::where('post_type', '=', 'sannif-online')->active()->first();

		$this->data['parentGuide'] = PostModel::where('post_type', '=', 'parent_guide_intro')->active()->first();
		$this->data['educatorGuide'] = PostModel::where('post_type', '=', 'educator_guide_intro')->active()->first();

		$this->data['aboutUsQuestionsList'] = PostModel::where('post_type', '=', 'about_us_questions')->active()->orderBy('post_priority', 'ASC')->get();
		$this->data['aboutUs'] = PostModel::where('post_type', '=', 'about_us')->active()->orderBy('post_priority', 'ASC')->get();
		$this->data['guidesAndTipsList'] = PostModel::with('tagged')->where('post_type', '=', 'guides_and_tips')->whereMeta('guide_lang', $lang)->active()->orderBy('post_priority', 'ASC')->paginate(6);

		// $this->data['homeYoutubeGal'] = PostModel::where('post_type','=','youtube_gallery')
		// 	->whereMeta('display_on_home', 'yes')
		// 	->with('videoGallery')
		// 	->active()
		// 	->orderBy('post_priority','ASC')
		// 	->get()
		// 	->take(7);

		$gallery_ids = PostModel::where('post_type', '=', 'youtube_gallery')
			->whereMeta('display_on_home', '=', 'yes')
			->active()
			->pluck('post_id')
			->toArray();

		// pre($gallery_ids);

		$this->data['homeYoutubeGal'] = PostMediaModel::whereNotNull('pm_post_id')
			->where('pm_cat', '=', 'video')
			->where(function ($q) use ($lang) {
				$q->where('pm_lang', '=', $lang);
				$q->orWhere('pm_lang', '=', '');
				$q->orWhereNull('pm_lang');
			})
			->whereIn('pm_post_id', $gallery_ids)
			->orderBy('pm_created_at', 'desc')
			->active()
			->get()
			->take(6);

		$this->data['brought_to_you_by'] = PostModel::where('post_type', '=', 'brought_to_you_by')->active()->first();
		$this->data['proudly_supported_by'] = PostModel::where('post_type', '=', 'proudly_supported_by')->active()->first();
		$this->data['supported_by'] = PostModel::where('post_type', '=', 'supported_by')->active()->first();

		$this->data['charter_pledge_popup'] = PostModel::where('post_type', '=', 'charter-pledge-popup')->active()->first();
		if ($this->data['lang'] == 'en') {
			$lang_title = 'post_title';

		} else {

			$lang_title = 'post_title_arabic';

		}

		$this->data['newsList'] = PostModel::with('category')->where('post_type', '=', 'news-opinion')->where($lang_title, '!=', 'NA')->active()->orderByMeta('publish_date', 'desc')->paginate(8);

		//dd($this->data['newsList']->toArray() );
		$this->data['resourceCategoryList'] = CategoryModel::where('category_parent_id', '=', 6)->orderBy('category_priority')->active()->get();

		foreach ($this->data['resourceCategoryList'] as $key => &$mainCat) {
			$mainCat->categoryList = PostModel::with('subCategory')->select('posts.*', \DB::raw('(SELECT category_priority FROM category_master WHERE posts.post_sub_category_id = category_master.category_id ) as sort'))->where('post_type', '=', 'resources')->where('post_category_id', $mainCat->category_id)->whereMeta('resource_lang', $lang)->active()->orderBy('sort')->groupBy('post_sub_category_id')->get();

			//$mainCat->categoryList = PostModel::with('subCategory')->where('post_type','=','resources')->where('post_category_id',$mainCat->category_id)->active()->groupBy('post_sub_category_id')->get();
		}

		//dd($this->data['resourceCategoryList']->toArray());

		$this->data['resourceSubCategoryList'] = CategoryModel::where('category_parent_id', '=', 1)->active()->orderBy('category_priority', 'ASC')->paginate(8);

		return view('frontend.index', $this->data);
	}

	public function checkIfRegistered(Request $request) {
		// dd($request->email);
		if (!empty($request->email)) {
			$registrant = CharterPledgeRegistrationModel::where('cpr_email_address', '=', $request->email)->exists();
			return !empty($registrant) ? 'false' : 'true';
		}
		return false;
	}

	public function fetchCouncilMember(Request $request) {
		$this->data['council'] = PostModel::where('post_type', 'council-members')
			->where('post_id', '=', $request->member_id)
			->first();

		return view('frontend.ajax.council_popup', $this->data);
	}

	public function viewCharterPledgeCertificate(Request $request) {
		$this->data['contact_name'] = \App::getLocale() == "en" ? "Mohammed Bin Rashid" : "محمد بن راشد";
		$pdfTemplate = 'frontend.certificate_templates.charter_pledge_certificate_' . \App::getLocale();
		$pdf = \PDF::loadView($pdfTemplate, $this->data, [], [
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
			'autoScriptToLang' => true,
			'autoLangToFont' => true,
			'allow_charset_conversion' => true,
		])->stream('certificate.pdf');
		// return view($pdfTemplate, $this->data);
	}

	// public function fetchElderlyPeopleVideos(Request $request) {
	// 	// if ($request->ajax()) {
	// 	$elderly_people = PostModel::where('post_type', '=', 'elderly-people')
	// 		->where('post_status', 1)
	// 		->when($request->search_keywords, function ($q) use ($request) {
	// 			$q->where('post_title', 'LIKE', '%' . filter_var($request->search_keywords, FILTER_SANITIZE_STRING | FILTER_SANITIZE_SPECIAL_CHARS) . '%')
	// 				->orWhere('post_title_arabic', 'LIKE', '%' . filter_var($request->search_keywords, FILTER_SANITIZE_STRING) . '%');
	// 		})
	// 		->orderBy('post_priority', 'asc')
	// 		->get();

	// 	$this->data['elderly_people'] = $elderly_people;

	// 	$dataHTML = view('frontend.ajax.elderly_people_videos', $this->data)->render();

	// 	return \Response::json([
	// 		'status' => true,
	// 		'dataCount' => $this->data['elderly_people']->count(),
	// 		'dataHTML' => $dataHTML,
	// 		// 'dataNext' => $dataNext
	// 	]);
	// 	// }
	// }

	public function setlanguage($lang, Request $request) {

		$allowedLangs = ['en', 'ar'];

		if (!in_array($lang, $allowedLangs)) {
			return redirect()->to('page-not-found');
		}

		if (!empty($lang)) {
			$request->session()->put('lang', $lang);
		}

		\App::setLocale($lang);

		$redirectURL = url()->previous();
		//dd(strpos($redirectURL,$request->getSchemeAndHttpHost()));
		if (strpos($redirectURL, $request->getSchemeAndHttpHost()) != 0) {
			$redirectURL = null;
		}
		if ($this->data['websiteSettings']->disable_arabic == 2) {

			if (!empty($redirectURL)) {
				$redirectURL = str_replace('/ar/', '/en/', $redirectURL);
				return redirect()->to($redirectURL)->with('homeMessage', $this->custom_message('Arabic version will be coming soon.', 'success'));

			}
			return redirect()->to('/')->with('homeMessage', $this->custom_message('Arabic version will be coming soon.', 'success'));

		}

		if (!empty($redirectURL)) {
			if($redirectURL == "https://digitalwellbeing.ae/ar" || $redirectURL == "https://digitalwellbeing.ae/en") {
			    $redirectURL .= "/";
			}
			if ($lang == 'ar') {

				$redirectURL = str_replace('/en/','/ar/', $redirectURL);
			} else {
				$redirectURL = str_replace('/ar/', '/en/', $redirectURL);
			}

			return redirect()->to($redirectURL);
		}

		return redirect()->to('/' . $lang);
	}

	public function page_not_found() {
		$this->data['bodyClass'] = ' inner__page domLoaded';
		return view('errors.404', $this->data);
	}

	public function test() {
		\Artisan::call('config:cache');
	}

	public function service_not_available() {
		$this->data['bodyClass'] = ' inner__page domLoaded';
		return view('errors.503', $this->data);
	}

}
