<?php
namespace App\Http\Controllers;

use App\Models\Admodels\CharterPledgeRegistrationModel;
use App\Models\Admodels\CountryModel;
use App\Models\Admodels\MenuManagerModel;
use App\Models\Admodels\PostModel;
use App\Models\Admodels\PostTagModel;
use App\Models\CategoryModel;
use DB;
use File;
use Illuminate\Http\Request;
use Lang;

class ContentController extends FrontendBaseController {

	protected $layout = 'frontend.layouts.master';

	private $ajaxData = array();

	public function __construct() {
		parent::__construct();
	}

	public function index($lang = 'ar', $alias, $subalias = '', Request $request) {

		$page = 'errors.404';
		$this->data['active_menu'] = $alias;

		$this->data['pageDetails'] = MenuManagerModel::where('mm_slug', $alias)->first();

		// dd($alias);

		$this->data['pageTitle'] = (!empty($this->data['pageDetails'])) ? $this->data['pageDetails']->getData('mm_title') : '';
		switch ($alias) {
			case 'charter-pledge':
				$page = "frontend.charter_pledge";
				$this->data['bodyClass'] = "__charter-pledge";

				$charter_pledge = PostModel::where('post_type', 'charter-pledge-banner')->first();
				$this->data['pledge_list'] = PostModel::where('post_type', 'pledge-list')
					->where('post_status', 1)
					->orderBy('post_priority', 'asc')
					->get();

				$this->data['countries'] = CountryModel::orderByRaw('(country_id = 221) desc')->get();

				$totalPledgers = CharterPledgeRegistrationModel::count();
				$this->data['totalPledgers'] = number_format($totalPledgers);

				$postDetails = $charter_pledge;
				break;

			case 'elderly-people':
				$page = "frontend.elderly_people";
				$this->data['bodyClass'] = "__elderly-people";

				$elderly_people = PostModel::where('post_type', 'elderly-people')
					->where('post_status', 1);
				// ->orderBy('post_priority', 'asc')
				// ->get();

				// Search function -- AJAX
				if ($request->ajax()) {
					if (!empty($request->input('search_keywords'))) {
						switch ($lang) {
							case 'en':
								$column = "post_title";
								break;

							case 'ar':
								$column = "post_title_arabic";
								break;
						}
						$elderly_people->where($column, 'LIKE', '%' . filter_var($request->input('search_keywords'), FILTER_SANITIZE_STRING | FILTER_SANITIZE_SPECIAL_CHARS) . '%');
					}

					$this->data['elderly_people'] = $elderly_people->orderBy('post_priority', 'asc')->get();

					$dataHTML = view('frontend.ajax.elderly_people_videos', $this->data)->render();

					return \Response::json([
						'status' => true,
						'dataCount' => $this->data['elderly_people']->count(),
						'dataHTML' => $dataHTML,
						// 'dataNext' => $dataNext
					]);
				}

				$this->data['elderly_people'] = $elderly_people->orderBy('post_priority', 'asc')->get();
				$elderly_people_banner = PostModel::where('post_type', 'elderly-people-banner')->first();

				$postDetails = $elderly_people_banner;
				break;

			case 'the-council':
				$page = "frontend.council";
				$this->data['bodyClass'] = "__council";
				$this->data['council_members'] = PostModel::where('post_type', 'council-members')
					->where('post_status', 1)
					->orderBy('post_priority', 'asc')
					->get();
				// ->paginate(8);

				// if($request->ajax()){
				//     $dataNext=(!empty( $this->data['council_members']->nextPageUrl()))? $this->data['council_members']->nextPageUrl():'';
				//     $dataHTML = view('frontend.ajax.council_members',$this->data)->render();
				//     return \Response::json(array('status'=>true,'dataHTML'=>$dataHTML,'dataNext'=>$dataNext));
				// }

				$postDetails = $this->data['council_members'];

				$this->data['about_council'] = PostModel::where('post_type', 'about-council')
					->where('post_status', 1)
					->orderBy('post_priority', 'asc')
					->first();

				$this->data['about_council_facts'] = PostModel::where('post_type', 'about-council-facts')
					->where('post_status', 1)
					->orderBy('post_priority', 'asc')
					->get();

				break;

			case 'about_us':
			case 'about-us':
				$page = 'frontend.about_us';
				$this->data['bodyClass'] = '__about_us';
				$about_details = PostModel::where('post_type', '=', 'about_us')->active()->first();
				if (empty($about_details)) {
					return redirect()->to('/page-not-found');
				}
				$this->data['about_details'] = $about_details;
				$postDetails = $about_details;
				break;

			case 'resources':
				$page = 'frontend.resources';
				$this->data['bodyClass'] = '__resources';
				$this->data['resourceCategoryList'] = CategoryModel::where('category_parent_id', '=', 6)->active()->get();

				$cat_id = $request->input('cat_id');

				$filterLang = $request->input('lang');

				if (!empty($subalias) && empty($cat_id)) {
					$this->data['activeCategory'] = CategoryModel::where('category_slug', '=', $subalias)->active()->first();
					$this->data['activeSubCategory'] = $request->input('sc');
					if (!empty($this->data['activeCategory'])) {
						$cat_id = $this->data['activeCategory']->category_id;
					}
				}

				if (empty($cat_id)) {
					$this->data['resourceSubCategoryList'] = PostModel::with('subCategory')->select('posts.*', \DB::raw('(SELECT category_priority FROM category_master WHERE posts.post_sub_category_id = category_master.category_id ) as sort'))->where('post_type', '=', 'resources')->where('post_sub_category_id', '!=', '')->whereMeta('resource_lang', $lang)->active()->orderBy('sort')->groupBy('post_sub_category_id')->get();
				} else {
					$this->data['resourceSubCategoryList'] = PostModel::with('subCategory')->select('posts.*', \DB::raw('(SELECT category_priority FROM category_master WHERE posts.post_sub_category_id = category_master.category_id ) as sort'))->where('post_type', '=', 'resources')->where('post_category_id', $cat_id)->whereMeta('resource_lang', $lang)->active()->orderBy('sort')->groupBy('post_sub_category_id')->get();
				}

				/*  ref link */
				/* https://zaengle.com/blog/sorting-parent-models-by-a-child-relationship */
				/*  ref link */

				$this->data['resourceList'] = PostModel::with('subCategory', 'tagged')->where('post_type', '=', 'resources')->whereMeta('resource_lang', $lang)
					->when($cat_id, function ($q) use ($cat_id) {
						$q->where('post_category_id', $cat_id);
					})
					->when($filterLang, function ($l) use ($filterLang) {
						$l->whereMeta('resource_lang', $filterLang);
					})
					->where('post_sub_category_id', '!=', '')
					->orderBy('post_priority', 'ASC')

					->active()->get();

				if ($request->ajax()) {
					$renderHtml = View('frontend.ajax.resources.tab_content', $this->data)->render();
					return \Response::json(array('status' => true, 'renderHtml' => $renderHtml));
				}
				$postDetails = $this->data['resourceCategoryList'];
				break;

			case 'digital-domains':
			case 'digital_domains':
				$page = 'frontend.digital_domains';
				$this->data['bodyClass'] = '__digital_domains';

				$digitalDomainList = PostModel::where('post_type', '=', 'digital_domains')->active()->get();

				$this->data['digital_domainsList'] = $digitalDomainList;

				if (empty($digitalDomainList) && empty($subalias)) {
					return redirect()->to('/page-not-found');
				}
				$postDetails = $digitalDomainList;
				if ($subalias) {
					if ($request->input('color')) {
						$this->data['fill_color'] = $request->input('color');
					}
					$digitalDomain = PostModel::where('post_type', '=', 'digital_domains')->where('post_slug', $subalias)->active()->first();
					if (empty($digitalDomain)) {
						return redirect()->to('/page-not-found');
					}
					$this->data['digital_domain'] = $digitalDomain;

					$page = 'frontend.digital_domains_details';

					$postDetails = $digitalDomain;
				}

				break;

			case 'about_digital_wellbeing':
				$page = 'frontend.about_digital_wellbeing';
				$this->data['bodyClass'] = '__about_digital_wellbeing';
				$aboutDWB = PostModel::where('post_type', '=', 'about_digital_wellbeing')->active()->first();
				if (empty($aboutDWB)) {
					return redirect()->to('/page-not-found');
				}
				$this->data['about_digital_wellbeing'] = $aboutDWB;
				$postDetails = $aboutDWB;
				break;

			case 'digital-citizenship':
			case 'digital_citizenship':
				$page = 'frontend.digital_citizenship';
				$this->data['bodyClass'] = '__digital_citizenship';
				$digital_citizenship = PostModel::where('post_type', '=', 'digital_citizenship')->active()->first();
				if (empty($digital_citizenship)) {
					return redirect()->to('/page-not-found');
				}
				$this->data['digital_citizenship'] = $digital_citizenship;
				$postDetails = $digital_citizenship;
				break;

			case 'sannif-online-games-classification':
				$page = 'frontend.sannif_online';
				$this->data['bodyClass'] = '__digital_citizenship';
				$sannif_online = PostModel::where('post_type', '=', 'sannif-online')->active()->first();
				if (empty($sannif_online)) {
					return redirect()->to('/page-not-found');
				}
				$this->data['sannif_online'] = $sannif_online;
				$postDetails = $sannif_online;
				break;

			case 'parent_guides':
			case 'parents':
				$page = 'frontend.parents';
				$this->data['bodyClass'] = '__parents';
				$parent_guides = PostModel::where('post_type', '=', 'parent_guides')->active()->orderBy('post_priority', 'ASC')->get();
				if (empty($parent_guides)) {
					return redirect()->to('/page-not-found');
				}

				$this->data['parent_guides'] = $parent_guides;

				$this->data['parentIntro'] = PostModel::where('post_type', '=', 'parent_guide_intro')->active()->first();

				$postDetails = $parent_guides;
				break;
			case 'educator_guides':
			case 'educators':
				$page = 'frontend.educator';
				$this->data['bodyClass'] = '__educator';
				$educator_guides = PostModel::where('post_type', '=', 'educator_guides')->active()->get();
				if (empty($educator_guides)) {
					return redirect()->to('/page-not-found');
				}

				$this->data['educator_guides'] = $educator_guides;
				$postDetails = $educator_guides;
				$this->data['educatorIntro'] = PostModel::where('post_type', '=', 'educator_guide_intro')->active()->first();
				break;
			case 'guides_and_tips':
			case 'guides-tips':
				$page = 'frontend.guides_and_tips';
				$this->data['bodyClass'] = '__guides_and_tips';

				//$this->data['tags']=$this->getPostTypeTags('guides_and_tips');

				// dd($this->data['tags']);

				$this->data['tags'] = PostTagModel::whereHas('tagPost', function ($q) use ($lang) {
					$q->where('post_type', 'guides_and_tips');
					$q->whereMeta('guide_lang', $lang);
				})->groupBy('tag_name')->get();

				$guides_and_tips = PostModel::with('tagged')
					->when($request->tag, function ($q) use ($request) {
						$q->withAnyTag([$request->tag]);
					})
					->where('post_type', '=', 'guides_and_tips')->whereMeta('guide_lang', $lang)->active()->orderBy('post_priority', 'ASC')->paginate(6);

				if (empty($guides_and_tips) && empty($subalias)) {
					return redirect()->to('/page-not-found');
				}

				if ($subalias) {
					$guides_and_tips_details = PostModel::with('tagged')->where('post_slug', $subalias)->active()->first();
					if (empty($guides_and_tips_details)) {
						return redirect()->to('/page-not-found');
					}
					$this->data['guides_and_tips_details'] = $guides_and_tips_details;
					$postDetails = $guides_and_tips_details;
					$page = 'frontend.guides_and_tips_details';
				}
				$this->data['guides_and_tips'] = $guides_and_tips;

				if ($request->ajax()) {
					$dataNext = (!empty($guides_and_tips->nextPageUrl())) ? $guides_and_tips->nextPageUrl() : '';
					$dataHTML = view('frontend.ajax.guides_and_tips_loader', $this->data)->render();
					return \Response::json(array('status' => true, 'dataHTML' => $dataHTML, 'dataNext' => $dataNext));
				}

				//pre($guides_and_tips);
				$postDetails = $guides_and_tips;
				break;

			case 'youtube_gallery':
				$page = 'frontend.youtube_gallery';
				$this->data['bodyClass'] = '__youtube_gallery';

				/*     $youtube_gallery= PostModel::with(['videoGallery'])->where('post_type','=','youtube_gallery')
					                ->when($request->tag,function($q) use($request){
					                $q->where('post_category_id','=',$request->tag);
					                })
					                ->active()->get();
				*/

				$ignoreLang = ($lang == 'en') ? 'ar' : 'en';

				$postsTmp = PostModel::where('post_type', 'youtube_gallery')
					->where('post_status', 1)
					->whereNull('posts.deleted_at')
					->join('post_media', 'post_id', 'pm_post_id')
					->whereNotNull('pm_post_id')
					->where('pm_lang', '!=', $ignoreLang)
					->where('pm_status', 1)
					->whereNull('post_media.deleted_at')
					->orderBy('post_priority', 'asc');
				if ($request->has('tag')) {
					$postsTmp->where('post_category_id', '=', $request->input('tag'));
				}

				$youtube_gallery = $postsTmp->paginate(6);

				//pre($youtube_gallery);

				/*     $youtube_gallery=PostMediaModel::with(['postDetails'=>function($q){
					                $q->orderBy('post_priority','desc');

					                }])
					                ->where('pm_lang','!=',$ignoreLang)
					                ->where('pm_status',1)
					                ->whereHas('postDetails',function($q) use($request){
					                $q->where('post_type','youtube_gallery');
					                if($request->tag){
					                $q->where('post_category_id','=',$request->tag);
					                }

				*/

				//pre($youtube_gallery->toArray());

				/* $youtube_gallery_new= PostModel::with(['videoGallery'])->where('post_type','=','youtube_gallery')
					                ->when($request->tag,function($q) use($request){
					                $q->where('post_category_id','=',$request->tag);
					                })
					                ->active()->first();

					                if(!empty(($youtube_gallery_new))){
					                $youtube_gallery=$youtube_gallery_new->videoGallery->paginate(6);
				*/

				if (empty($youtube_gallery)) {
					return redirect()->to('/page-not-found');
				}
				//dd($youtube_gallery->toArray());
				$this->data['youtube_gallery'] = $youtube_gallery;
				if ($request->ajax()) {
					$dataNext = (!empty($youtube_gallery->nextPageUrl())) ? $youtube_gallery->nextPageUrl() : '';
					$dataHTML = view('frontend.ajax.youtube_gallery_loader', $this->data)->render();
					return \Response::json(array('status' => true, 'dataHTML' => $dataHTML, 'dataNext' => $dataNext));
				}
				$postDetails = $youtube_gallery;

				$this->data['resourceSubCategoryList'] = CategoryModel::where('category_parent_id', '=', 6)->active()->get();

				break;
			case 'our-events':
				$page = 'frontend.our_events';
				$this->data['bodyClass'] = '__our_events';
				$this->data['EventsCategoryList'] = CategoryModel::where('category_parent_id', '=', 24)->active()->get();
				//dd($this->data['EventsCategoryList']->toArray());
				$lang_title = 'post_title';
				if ($this->data['lang'] == 'ar') {
					$lang_title = 'post_title_arabic';
				}

				$our_events = PostModel::where('post_type', '=', 'our-events')->where($lang_title, '!=', 'NA')
					->when($request->month, function ($q) use ($request) {
						$q->whereMonthMeta('publish_date', $request->month);
					})
					->when($request->cat, function ($q) use ($request) {
						$q->where('post_category_id', $request->cat);
					})
					->orderByMeta('publish_date', 'DESC')->active()->paginate(6);

				if (empty($our_events) && empty($subalias)) {
					return redirect()->to('/page-not-found');
				}
				$postDetails = $our_events;
				if ($subalias) {
					$our_events_details = PostModel::where('post_slug', $subalias)->where($lang_title, '!=', 'NA')->active()->first();

					if (empty($our_events_details)) {
						return redirect()->to($lang . '/our-events');
					}
					$this->data['our_events_details'] = $our_events_details;
					$postDetails = $our_events_details;
					$page = 'frontend.our_events_details';
				}
				$this->data['our_events'] = $our_events;
				if ($request->ajax()) {
					$dataNext = (!empty($our_events->nextPageUrl())) ? $our_events->nextPageUrl() : '';
					$dataHTML = view('frontend.ajax.our_events_loader', $this->data)->render();
					return \Response::json(array('status' => true, 'dataHTML' => $dataHTML, 'dataNext' => $dataNext));
				}
				break;
			case 'news_and_opinions':
			case 'news-opinion':
				$page = 'frontend.news_and_opinions';
				$this->data['bodyClass'] = '__news_and_opinions';
				$this->data['tags'] = $this->getPostTypeTags('news-opinion');
				if ($this->data['lang'] == 'en') {
					$lang_title = 'post_title';
					//$title = 'post_title';
				} else {
					$lang_title = 'post_title_arabic';
					//$title = 'post_title_arabic';
				}

				$news_and_opinions = PostModel::where('post_type', '=', 'news-opinion')->where($lang_title, '!=', 'NA')
				/* ->when($request->tag,function($q) use($request){
					                $q->withAnyTag([$request->tag]);
				*/
					->when($request->tag, function ($q) use ($request) {
						$q->where('post_category_id', '=', $request->tag);
					})

					->orderByMeta('publish_date', 'DESC')->orderBy('post_priority', 'ASC')->active()->paginate(6);

				if (empty($news_and_opinions) && empty($subalias)) {
					return redirect()->to('/page-not-found');
				}

				if ($subalias) {
					$news_and_opinions_details = PostModel::with(['category'])->where('post_slug', $subalias)->where($lang_title, '!=', 'NA')->active()->first();
					if (empty($news_and_opinions_details)) {
						return redirect()->to($lang . '/news-opinion');
					}

					$this->data['news_and_opinions_details'] = $news_and_opinions_details;

					$page = 'frontend.news_and_opinions_details';
				}
				$this->data['news_and_opinions'] = $news_and_opinions;

				if ($request->ajax()) {
					$dataNext = (!empty($news_and_opinions->nextPageUrl())) ? $news_and_opinions->nextPageUrl() : '';
					$dataHTML = view('frontend.ajax.news_and_opinions_loader', $this->data)->render();
					return \Response::json(array('status' => true, 'dataHTML' => $dataHTML, 'dataNext' => $dataNext));
				}
				$postDetails = $news_and_opinions;
				$this->data['resourceSubCategoryList'] = CategoryModel::where('category_parent_id', '=', 6)->active()->get();
				break;
			case 'people-of-determination':
				$page = 'frontend.people_of_determination';
				$this->data['bodyClass'] = '__people-of-determination';
				//$this->data['tags'] = $this->getPostTypeTags('news-opinion');
				if ($this->data['lang'] == 'en') {
					$lang_title = 'post_title';
					//$title = 'post_title';
				} else {
					$lang_title = 'post_title_arabic';
					//$title = 'post_title_arabic';
				}

				//
				$this->data['determination'] = PostModel::where('post_type', 'determination')->first();

				//Articles
				$determination_articles = PostModel::where('post_type', '=', 'determination_article')->where($lang_title, '!=', 'NA')
					->orderByMeta('publish_date', 'DESC')->orderBy('post_priority', 'ASC')->active()->paginate(3);

				//Blogs
				$determination_blogs = PostModel::where('post_type', '=', 'determination_blog')->where($lang_title, '!=', 'NA')
					->when($request->tag, function ($q) use ($request) {
						$q->where('post_category_id', '=', $request->tag);
					})

					->orderByMeta('publish_date', 'DESC')->orderBy('post_priority', 'ASC')->active()->paginate(3);

				$ajaxResponse = [
					'status' => true,
					'lang' => $lang,
				];

				if ($request->ajax()) {
					if (request()->input('_tab') == "articles") {
						$this->data['determination_articles'] = $determination_articles;
						$ajaxResponse['moreArticle'] = !empty($determination_articles->nextPageUrl()) ? $determination_articles->nextPageUrl() : '';
						$ajaxResponse['articleHTML'] = view('frontend.ajax.determination_articles_loader', $this->data)->render();
						return response()->json($ajaxResponse);
					} elseif (request()->input('_tab') == "blogs") {
						$this->data['determination_blogs'] = $determination_blogs;
						$ajaxResponse['moreBlog'] = !empty($determination_blogs->nextPageUrl()) ? $determination_blogs->nextPageUrl() : '';
						$ajaxResponse['blogHTML'] = view('frontend.ajax.determination_blogs_loader', $this->data)->render();
						return response()->json($ajaxResponse);
					}
				}

				$this->data['determination_articles'] = $determination_articles;
				$this->data['determination_blogs'] = $determination_blogs;

				break;
			case 'young-people':
				$page = 'frontend.young_people';
				$this->data['bodyClass'] = '__young-people';
				$this->data['tags'] = $this->getPostTypeTags('young_people_article');
				if ($this->data['lang'] == 'en') {
					$lang_title = 'post_title';
					//$title = 'post_title';
				} else {
					$lang_title = 'post_title_arabic';
					//$title = 'post_title_arabic';
				}

				//
				$this->data['young_people'] = PostModel::where('post_type', 'young_people')->first();

				//Articles
				$young_people_articles = PostModel::with('tagged')->where('post_type', '=', 'young_people_article')->where($lang_title, '!=', 'NA')
					->when($request->tag, function ($q) use ($request) {
						$q->withAnyTag($request->tag);
					})
					->orderByMeta('publish_date', 'DESC')->orderBy('post_priority', 'ASC')->active()->paginate(3);

				//Blogs
				$young_people_blogs = PostModel::where('post_type', '=', 'young_people_blog')->where($lang_title, '!=', 'NA')
					->orderByMeta('publish_date', 'DESC')->orderBy('post_priority', 'ASC')->active()->paginate(3);

				$ajaxResponse = [
					'status' => true,
					'lang' => $lang,
				];

				if ($request->ajax()) {
					if (request()->input('_tab') == "articles") {
						$this->data['young_people_articles'] = $young_people_articles;
						$ajaxResponse['moreArticle'] = !empty($young_people_articles->nextPageUrl()) ? $young_people_articles->nextPageUrl() : '';
						$ajaxResponse['articleHTML'] = view('frontend.ajax.young_people_articles_loader', $this->data)->render();
						return response()->json($ajaxResponse);
					} elseif (request()->input('_tab') == "blogs") {
						$this->data['young_people_blogs'] = $young_people_blogs;
						$ajaxResponse['moreBlog'] = !empty($young_people_blogs->nextPageUrl()) ? $young_people_blogs->nextPageUrl() : '';
						$ajaxResponse['blogHTML'] = view('frontend.ajax.young_people_blogs_loader', $this->data)->render();
						return response()->json($ajaxResponse);
					}
				}

				$this->data['young_people_articles'] = $young_people_articles;
				$this->data['young_people_blogs'] = $young_people_blogs;

				break;
			case 'children':
				$page = 'frontend.children_home';
				$this->data['bodyClass'] = '__children-home';

				if ($this->data['lang'] == 'en') {
					$lang_title = 'post_title';
					//$title = 'post_title';
				} else {
					$lang_title = 'post_title_arabic';
					//$title = 'post_title_arabic';
				}

				//tab1
				$CategoryList = PostModel::where('post_type', '=', 'be_an_esafe_kid')->active()->get();

				//tab2
				$ArticleList = PostModel::where('post_type', '=', 'i_want_help_with_article')->orderBy('post_priority', 'asc')->active()->paginate(4);

				//tab3
				$aboutEsafety = PostModel::where('post_type', '=', 'kid_esafety')->active()->first();
				$reportQuestios = PostModel::where('post_type', '=', 'report_question')->active()->get();
				$ajaxResponse = [
					'status' => true,
					'lang' => $lang,
				];

				if ($request->ajax()) {
					if (request()->input('_tab') == "articles") {
						$this->data['ArticleList'] = $ArticleList;
						$ajaxResponse['moreArticle'] = !empty($ArticleList->nextPageUrl()) ? str_replace('http://172.21.19.103', 'https://digitalwellbeing.ae', $ArticleList->nextPageUrl()) : '';
						$ajaxResponse['articleHTML'] = view('frontend.ajax.children_help_with_loader', $this->data)->render();
						return response()->json($ajaxResponse);
					}
				}

				$postDetails = $CategoryList;
				$this->data['CategoryList'] = $CategoryList;
				$this->data['ArticleList'] = $ArticleList;
				$this->data['aboutEsafety'] = $aboutEsafety;
				$this->data['reportQuestios'] = $reportQuestios;

				break;
			case 'be-an-esafe-kid':
				$page = 'frontend.esafe_kid_article';
				$this->data['bodyClass'] = '__article-details';
				//$this->data['tags'] = $this->getPostTypeTags('news-opinion');
				if ($this->data['lang'] == 'en') {
					$lang_title = 'post_title';
					//$title = 'post_title';
				} else {
					$lang_title = 'post_title_arabic';
					//$title = 'post_title_arabic';
				}

				$articleDetails = PostModel::where('post_slug', '=', $subalias)->active()->first();

				if (empty($articleDetails)) {
					return redirect()->to('/page-not-found');
				}

				$relatedArticles = PostModel::where('post_type', '=', 'be_an_esafe_kid_article')->where('post_id', '!=', $articleDetails->post_id)->active()->orderByRaw('RAND()')->limit(10)->get();

				$postDetails = $articleDetails;
				$this->data['articleDetails'] = $articleDetails;
				$this->data['relatedArticles'] = $relatedArticles;

				break;
			case 'i-want-help-with':
				$page = 'frontend.i_want_help_with_article';
				$this->data['bodyClass'] = '__help-details';
				//$this->data['tags'] = $this->getPostTypeTags('news-opinion');
				if ($this->data['lang'] == 'en') {
					$lang_title = 'post_title';
					//$title = 'post_title';
				} else {
					$lang_title = 'post_title_arabic';
					//$title = 'post_title_arabic';
				}

				$articleDetails = PostModel::where('post_slug', '=', $subalias)->active()->first();

				$postDetails = $articleDetails;
				$this->data['articleDetails'] = $articleDetails;

				break;
			default:
				$page = 'frontend.default'; //$page = 'errors.404';
				break;
		}

		if (empty($postDetails)) {
			$postDetails = PostModel::where('post_slug', '=', $alias)->orWhere('post_slug', '=', $subalias)->orWhere('post_type', '=', $alias)->active()->first();
			$this->data['postDetails'] = $postDetails;
		}

		if (empty($postDetails)) {
			return redirect()->to('/page-not-found');
		}

		$pageTitle = (!empty($postDetails->post_title)) ? strip_tags($postDetails->getData('post_title')) : '';
		$this->data['pageTitle'] = (!empty($this->data['pageTitle'])) ? $this->data['pageTitle'] : $pageTitle;
		return view($page, $this->data);
	}

	public function articleDetails($lang = 'ar', $alias = '', $subalias = '', Request $request) {

		switch ($alias) {
			case 'determination':
				$postDetails = PostModel::with(['category'])->where('post_slug', $subalias)->active()->first();
				if (empty($postDetails)) {
					return redirect()->to($lang . '/people-of-determination');
				}

				$this->data['postDetails'] = $postDetails;
				$page = 'frontend.determination_article_details';
				break;
			case 'young-people':
				$postDetails = PostModel::with(['category'])->where('post_slug', $subalias)->active()->first();
				if (empty($postDetails)) {
					return redirect()->to($lang . '/young-people');
				}

				$this->data['postDetails'] = $postDetails;
				$this->data['tags'] = $this->getPostTypeTags('young_people_article');
				$page = 'frontend.young_people_article_details';
				break;

			default:
				$page = 'frontend.default'; //$page = 'errors.404';
				break;
		}

		if (empty($postDetails)) {
			return redirect()->to('/page-not-found');
		}

		$pageTitle = (!empty($postDetails->post_title)) ? strip_tags($postDetails->getData('post_title')) : '';
		$this->data['pageTitle'] = (!empty($this->data['pageTitle'])) ? $this->data['pageTitle'] : $pageTitle;
		return view($page, $this->data);
	}

	public function blogDetails($lang = 'ar', $alias = '', $subalias = '', Request $request) {

		switch ($alias) {
			case 'determination':
				$postDetails = PostModel::with(['category'])->where('post_slug', $subalias)->active()->first();
				if (empty($postDetails)) {
					return redirect()->to($lang . '/people-of-determination');
				}

				$this->data['postDetails'] = $postDetails;
				$page = 'frontend.determination_blog_details';
				break;
			case 'young-people':
				$postDetails = PostModel::with(['category'])->where('post_slug', $subalias)->active()->first();
				if (empty($postDetails)) {
					return redirect()->to($lang . '/young-people');
				}

				$this->data['postDetails'] = $postDetails;
				$page = 'frontend.young_people_blog_details';
				break;

			default:
				$page = 'frontend.default'; //$page = 'errors.404';
				break;
		}

		if (empty($postDetails)) {
			return redirect()->to('/page-not-found');
		}

		$pageTitle = (!empty($postDetails->post_title)) ? strip_tags($postDetails->getData('post_title')) : '';
		$this->data['pageTitle'] = (!empty($this->data['pageTitle'])) ? $this->data['pageTitle'] : $pageTitle;
		return view($page, $this->data);
	}

	public function download_practice($lang, $id) {
		$bcId = (int) $id;
		$bpDoc = BestPracticeModel::where('bp_id', $id)->first();
		$file = (!empty($bpDoc->getData('bp_doc_file'))) ? $bpDoc->getData('bp_doc_file') : '';
		$name = (!empty($bpDoc->getData('bp_doc_file_tmp'))) ? $bpDoc->getData('bp_doc_file_tmp') : 'doc';
		$pathParts = pathinfo('storage/app/public/post/' . $file);

		if (!empty($file) && File::exists(storage_path('app/public/post/' . $file))) {
			return \Response::download('storage/app/public/post/' . $file, $name . '.' . $pathParts['extension']);
		}
		return false;
	}
	public function getPostTypeTags($postType) {
		return PostTagModel::whereHas('tagPost', function ($q) use ($postType) {
			$q->where('post_type', $postType);
		})->groupBy('tag_name')->get();
	}
	public function live_stream() {
		$this->data['bodyClass'] = " __about";
		$page = 'frontend.live_stream';

		$this->data['pageTitle'] = lang('live_now');
		return View($page, $this->data);
	}
	public function search($lang, Request $request) {
		$searchTerm = $request->input('search');
		//pre($searchTerm);
		// $searchTerm = implode("[","",$searchTerm);
		// $searchTerm = str_replace("]","",$searchTerm);

		if (is_array($searchTerm)) {
			$searchTerm = multi_implode($searchTerm, " ");
		}

		$this->data['searchList'] = '';
		if (!empty($searchTerm)) {
			$this->data['searchList'] = PostModel::where(function ($query) use ($searchTerm) {
				$query->orWhere('post_title', 'LIKE', '%' . $searchTerm . '%');
				$query->orWhere('post_title_arabic', 'LIKE', '%' . $searchTerm . '%');
			})
				->join('meta as M', function ($q) use ($searchTerm) {
					$q->on('posts.post_id', '=', 'M.metable_id');
				})
				->orWhere('M.value', 'LIKE', '%' . $searchTerm . '%')
				->where('post_type', '!=', 'banners')
				->where('post_type', '!=', 'parent_guide_intro')
				->where('post_type', '!=', 'educator_guide_intro')
				->where('post_type', '!=', 'parent_guide_intro')
				->where('post_type', '!=', 'about_us_questions')
				->where('post_status', 1)
				->groupBy('post_id')
				->paginate(10);
		}
		$this->data['searchTerm'] = $searchTerm;

		return view('frontend.search', $this->data);
	}

	public function articleByTags($lang = 'ar', $alias = '', $tagalias = '', Request $request) {

		$page = 'frontend.young_people_articles';
		$this->data['bodyClass'] = '__young-people';
		$this->data['tags'] = $this->getPostTypeTags('young_people_article');

		if ($this->data['lang'] == 'en') {
			$lang_title = 'post_title';
			//$title = 'post_title';
		} else {
			$lang_title = 'post_title_arabic';
			//$title = 'post_title_arabic';
		}

		//
		$this->data['young_people'] = PostModel::where('post_type', 'young_people')->first();

		//Articles
		$young_people_articles = PostModel::with('tagged')->where('post_type', '=', 'young_people_article')->where($lang_title, '!=', 'NA')
			->when($request->tag, function ($q) use ($request) {
				$q->withAnyTag($request->tag);
			})
			->orderByMeta('publish_date', 'DESC')->orderBy('post_priority', 'ASC')->active()->paginate(3);

		$ajaxResponse = [
			'status' => true,
			'lang' => $lang,
		];

		if ($request->ajax()) {
			$this->data['young_people_articles'] = $young_people_articles;
			$ajaxResponse['moreArticle'] = !empty($young_people_articles->nextPageUrl()) ? str_replace('http://172.21.19.103', 'https://digitalwellbeing.ae', $young_people_articles->nextPageUrl()) : '';
			$ajaxResponse['articleHTML'] = view('frontend.ajax.young_people_articles_loader', $this->data)->render();
			return response()->json($ajaxResponse);
		}

		$this->data['young_people_articles'] = $young_people_articles;
		$this->data['tagalias'] = $tagalias;

		$pageTitle = (!empty($postDetails->post_title)) ? strip_tags($postDetails->getData('post_title')) : '';
		$this->data['pageTitle'] = (!empty($this->data['pageTitle'])) ? $this->data['pageTitle'] : $pageTitle;
		return view($page, $this->data);
	}
}
