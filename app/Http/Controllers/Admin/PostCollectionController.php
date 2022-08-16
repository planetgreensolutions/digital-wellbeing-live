<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Base\AdminBaseController;
use App\Imports\GeneralExcelImport;
use App\Models\Admodels\PostMediaModel;
use App\Models\Admodels\PostModel;
use App\Models\CategoryModel;
use App\Providers\NestableCategoryServiceProvider;
use Config;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Input;
use Maatwebsite\Excel\Facades\Excel;

class PostCollectionController extends AdminBaseController
{

    protected $postType;
    //protected $postDateFormat = 'd/m/Y';
    protected $postDateFormat = 'm/d/Y';

    private $inputs = [];
    private $rules = [];
    private $messages = [];
    private $myValidator = [];
    private $validatorErrorMsgs;
    private $slugText = 'Post';
    private $singlePost = false;
    private $parentType = false;
    private $sorting;
    private $listing;
    private $filters;

    protected $roleName;
    protected $module;
    protected $hasYoutubeGallery = false;
    protected $hasGallery = false;

    public function __construct(Request $request)
    {

        parent::__construct($request);

        if ($this->requestSlug) {

            $this->_set_post_basic_settings($this->requestSlug, $request);
        }
        $slug = ucwords(str_replace(['_', '-'], ' ', $this->requestSlug)) . ' Manager';

        $this->module = ucwords(str_replace(['_', '-'], ' ', $this->requestSlug));
        $this->roleNames = ['Super Admin', $slug];

    }

    private function _set_post_validations($slug, $request)
    {

        $this->rules = [
            'post.title' => 'required',
            'post.title_arabic' => 'required',
            'post.status' => 'required',
        ];

        $this->messages = [
            'post.title.required' => 'Title is required',
            'post.title_arabic.required' => 'Arabic Title is required',
            'post.status.required' => 'Status is required',
        ];

        $slugRules = [];
        $slugMessages = [];

        switch ($slug) {

            case 'events':
                $this->postDateFormat = 'm/d/Y H:i';
                break;

        }

        $this->rules = array_merge($this->rules, $slugRules);
        $this->messages = array_merge($this->rules, $slugMessages);

        //(!empty($this->messages)) ? $this->validate($request,$this->rules,$this->messages) : $this->validate($request,$this->rules);
        return (!empty($this->messages)) ? $request->validate($this->rules, $this->messages) : $request->validate($this->rules);
    }

    // private function

    private function _set_post_basic_settings($slug, $request)
    {

        if (empty($slug)) {
            return false;
        }

        $this->data['postType'] = $slug;
        $this->data['hasGallery'] = false;
        $this->buttons = ['add' => true, 'edit' => true, 'delete' => false, 'status' => true];
        $this->hasGallery = true;
        $this->singlePost = false;
        $this->hideGalleryLang = false;
        $this->hideGalleryText = false;
        $this->hideGallerySource = false;

        $adminViewSettings = \Config::get('pgsadminviewsettings');
        if ((!empty($adminViewSettings[$slug]))) {

            if (!empty($adminViewSettings[$slug]['buttons'])) {
                foreach ($this->buttons as $key => $value) {
                    if (!empty($adminViewSettings[$slug]['buttons'][$key])) {
                        $this->buttons[$key] = $adminViewSettings[$slug]['buttons'][$key];
                    }
                }
            }

            $this->hasGallery = (!empty($adminViewSettings[$slug]['hasGallery'])) ? $adminViewSettings[$slug]['hasGallery'] : false;
            $this->singlePost = (!empty($adminViewSettings[$slug]['singlePost'])) ? $adminViewSettings[$slug]['singlePost'] : false;
            $this->hideGalleryLang = (!empty($adminViewSettings[$slug]['hideGalleryLang'])) ? $adminViewSettings[$slug]['hideGalleryLang'] : false;
            $this->hideGalleryText = (!empty($adminViewSettings[$slug]['hideGalleryText'])) ? $adminViewSettings[$slug]['hideGalleryText'] : false;
            $this->hideGallerySource = (!empty($adminViewSettings[$slug]['hideGallerySource'])) ? $adminViewSettings[$slug]['hideGallerySource'] : false;

            if (!empty($adminViewSettings[$slug]['sorting'])) {
                $this->sorting = $adminViewSettings[$slug]['sorting'];
            }

            if (!empty($adminViewSettings[$slug]['listing'])) {
                $this->listing = $adminViewSettings[$slug]['listing'];
            }

            if (!empty($adminViewSettings[$slug]['filters'])) {
                $this->filters = $adminViewSettings[$slug]['filters'];
            }

        }
        //pre($this->filters);
        $filterArr = array();
        if (!empty($this->filters)) {
            foreach ($this->filters as $key => $filter) {
                $filterArr[$key]['name'] = $filter['name'];
                $filterArr[$key]['type'] = $filter['type'];
                if (!empty($filter['source'])) {
                    $model = $filter['source']['model']::get();
                    $fieldId = $filter['source']['id'];
                    $fieldName = $filter['source']['name'];
                    foreach ($model as $key1 => $val) {

                        $filterArr[$key]['data'][$key1] = $val->$fieldId;
                        $filterArr[$key]['data'][$key1] = $val->$fieldName;

                    }

                }
            }
        }
        //    dd($filterArr);
        $this->data['hasGallery'] = $this->hasGallery;
        $this->data['hideGalleryLang'] = $this->hideGalleryLang;
        $this->data['hideGalleryText'] = $this->hideGalleryText;
        $this->data['hideGallerySource'] = $this->hideGallerySource;
        $this->data['buttons'] = $this->buttons;
        $this->data['filters'] = $filterArr;

        //pre($this->data['filters']);

    }

    private function hasParent()
    {
        $this->data['categories'] = null;
        if ($this->parentType) {
            $this->data['categories'] = PostModel::where('post_type', $this->parentType)->get();
        }
        return $this->data['categories'];
    }

    public function index($slug, Request $request)
    {

        $orderBy = [];
        $orderByMeta = [];
        $searchReq = ['post' => $request->post, 'meta' => $request->meta];

        if ($this->singlePost) {
            $post = PostModel::where('post_type', $slug)->first();
            if ($post) {
                return redirect()->to(route('post_edit', [$slug, $post->post_id]));
            }
            //if not then create one
            return redirect()->to(route('post_create', [$slug]));
        }

        switch ($slug) {
            case 'news-opinion':
                $orderByMeta = ['publish_date' => 'DESC', 'post_priority' => 'ASC'];
                break;
            case 'events':
                $orderByMeta = ['event_from_date' => 'DESC'];
                break;
            default:
                $orderBy = ['post_priority' => 'ASC'];
                break;
        } /* */

        $postItems = PostModel::where('post_type', '=', $slug);
        //pre($this->filters);
        if (!empty($this->filters)) {
            foreach ($this->filters as $filters) {
                $requestName = $filters['name'];
                if (!empty($request->$requestName)) {

                    if (strtolower($filters['operation']) == "like") {

                        foreach ($filters['field'] as $key => $fields) {

                            if ($key == 0) {
                                $postItems->where($fields, $filters['operation'], '%' . $request->$requestName . '%');
                            } else {
                                $postItems->orWhere($fields, $filters['operation'], '%' . $request->$requestName . '%');
                            }
                        }
                    } else {
                        foreach ($filters['field'] as $key => $fields) {

                            if ($key == 0) {
                                $postItems->where($fields, $filters['operation'], $request->$requestName);
                            } else {
                                $postItems->orWhere($fields, $filters['operation'], $request->$requestName);
                            }
                        }

                    }
                }
            }
        }

        // Search filter (both english and arabic keywords)
        if (!empty($request->post_title)) {
            //$postItems->where('post_title','LIKE','%'.$request->post_title.'%');
            $postItems->where(function ($q) use ($request) {
                $q->where('post_title', 'LIKE', '%' . $request->post_title . '%')
                    ->orWhere('post_title_arabic', 'LIKE', '%' . $request->post_title . '%');
            });

        }
        if (!empty($orderBy)) {
            foreach ($orderBy as $field => $sort) {
                $postItems = $postItems->orderBy($field, $sort);
            }
        }

        if (!empty($orderByMeta)) {
            foreach ($orderByMeta as $field => $sort) {
                $postItems = $postItems->OrderByMeta($field, $sort);
            }
        }

        if ($request->input('category')) {
            $postItems->where('post_category_id', $request->input('category'));
        }

        // Language Filter
        $postItems->when($request->post_language, function ($q) use ($request, $slug) {
            switch ($slug) {
                case "guides_and_tips":
                    $search_param = ($request->post_language == "en") ? "en" : "ar";
                    $q->whereMeta('guide_lang', '=', $search_param);
                    break;

                case "news-opinion":
                    if ($request->post_language == "en") {
                        $q->where('post_title', '!=', 'NA');
                    } else {
                        $q->where('post_title', '=', 'NA');
                    }

                    $q->where('post_title', '!=', 'Both');
                    break;

                default:
                    break;
            }
        });

        $postItems = $postItems->paginate(10);

        //dd($postItems->toArray());
        $this->data['post_items'] = $postItems;

        if (!view()->exists('admin.' . $slug . '.list')) {
            return View('admin.error.errorpage', $this->data);
        }

        return View('admin.' . $slug . '.list', $this->data);

    }

    public function create($slug, Request $request)
    {

        /* if(!$this->checkPermission('Create '.$this->module)){
        return redirect()->to(route('admin_dashboard'))->with('userMessage','Invalid Permission') ;
        } */

        if ($this->singlePost) {
            $post = PostModel::where('post_type', $slug)->first();
            if ($post) {
                return redirect()->to(route('post_edit', [$slug, $post->post_id]));
            }
        }

        $this->data['hasPluploader'] = $this->hasPluploader;
        $this->data['hasTextEditor'] = $this->hasTextEditor;
        $this->data['hasPluploader'] = true;
        $this->data['feedDetails'] = '';
        if ($request->input('btnsubmit')) {

            $userInputs = $request->all();
            $this->_set_post_validations($this->requestSlug, $request);
            // $this->_set_file_upload_settings($this->requestSlug, $request);

            try {

                // $postData = $this->_get_post_data($request);
                // pre($postData);
                $postMetaData = $this->_get_post_meta_data($request);
                // pre($postMetaData);
                DB::beginTransaction();

                $postData = $this->_get_post_data($request);

                $newPost = PostModel::create($postData);

                if (!empty($postMetaData)) {
                    $newPost->syncMeta($postMetaData);
                }

                $postMedia = $request->input('postMedia');

                if (!empty($postMedia)) {
                    $updateArr = [];
                    foreach ($postMedia as $key => $media) {
                        $temp = ['pm_post_id' => $newPost->post_id, 'pm_cat' => $key, 'pm_status' => 1];
                        PostMediaModel::whereIn('pm_id', $media)->update($temp);
                    }
                }

                // pre(array_keys($postChildrens));
                $tags = $request->input('post_tags');
                $finalTags = [];
                if (!empty($tags)) {
                    $tags = array_map('trim', explode(',', $tags));
                    foreach ($tags as $tag) {
                        if (!empty($tag)) {
                            $finalTags[] = $tag;
                        }
                    }
                    $newPost->tag($finalTags);
                }

                //Child posts > Multiple child in one post
                $postChildrens = $request->input('postChild');

                if (!empty($postChildrens)) {
                    $childPostData = $this->_get_child_post_data($request, $newPost->post_id);
                    // pre($childPostData);
                    foreach ($childPostData as $childData) {
                        $childPostArr = $childData['post'];

                        $childPostObj = PostModel::create($childPostArr);
                        if (!empty($childData['postMeta'])) {
                            $childPostObj->syncMeta($childData['postMeta']);
                        }
                    }
                }

                DB::commit();

                $this->data['userMessage'] = $this->custom_message($this->slugText . ' saved successfully.', 'success');

                // pre($this->data['userMessage']);
            } catch (\Exception $e) {
                // pre($e->getMessage());
                $request->flash();
                DB::rollback();
                $message = '<div class="alert alert-danger">Error occured while saving data.Error : ' . $e->getMessage() . '</div>';
                if ($e->getCode() == 23000) {
                    $message = '<div class="alert alert-danger">Title already exist, Please enter a different title</div>';
                }
                $this->data['userMessage'] = $message;
            }
        }

        if (!view()->exists('admin.' . $slug . '.add')) {
            return View('admin.error.errorpage', $this->data);
        }

        if ($slug == 'banners') {
            $this->data['allPost'] = PostModel::where('post_type', '!=', 'banners')->orderBy('post_created_at')->get()->groupBy(function ($item) {
                return $item->post_type;
            });
        }

        switch ($slug) {

            case "council-members":
                $this->data['council_roles'] = PostModel::where('post_type', 'council-roles')
                    ->where('post_status', 1)
                    ->orderBy('post_priority', 'asc')
                    ->get();
                break;

            case 'our-events':
                $this->data['EventsCategoryList'] = CategoryModel::where('category_parent_id', '=', 24)->active()->get();
                break;
            case 'news_and_opinions':
            case 'news-opinion':
                $this->data['NewsCategoryList'] = CategoryModel::where('category_parent_id', '=', 10)->active()->get();
                $this->data['resourceSubCategoryList'] = CategoryModel::where('category_parent_id', '=', 6)->active()->get();
                // pre($this->data['resourceSubCategoryList']);
                break;
            case 'resources':
                $this->data['resourceCategoryList'] = CategoryModel::where('category_parent_id', '=', 1)->active()->get();
                $this->data['resourceSubCategoryList'] = CategoryModel::where('category_parent_id', '=', 6)->active()->get();
                break;
            case 'youtube_gallery':
                $this->data['resourceSubCategoryList'] = CategoryModel::where('category_parent_id', '=', 6)->active()->get();
                break;
            case 'be_an_esafe_kid_article':
                $this->data['CategoryList'] = PostModel::where('post_type', '=', 'be_an_esafe_kid')->active()->get();
                break;
            default:
                $categoryList = CategoryModel::active()->get();
                $this->data['categoryList'] = $categoryList;
                $nestableConfig = $this->_GetCategoryNestableConfig();
                $nestableCategory = NestableCategoryServiceProvider::attr(['class' => 'form-control custom-select', 'name' => 'meta[text][category_id]'])->make($categoryList, $nestableConfig);

                $this->data['categoryDropDown'] = $nestableCategory->renderAsDropdown();
                break;
        }

        if ($slug == 'gallery') {
            $this->data['hasGallery'] = true;
        }

        $this->hasParent();

        // pre($request->all());
        return View('admin.' . $slug . '.add', $this->data);

    }

    public function edit($slug, $editId, Request $request)
    {

        /* if(!$this->checkPermission('Edit '.$this->module)){
        return redirect()->to(route('admin_dashboard'))->with('userMessage','Invalid Permission') ;
        } */

        $this->data['hasPluploader'] = $this->hasPluploader;
        $this->data['hasTextEditor'] = $this->hasTextEditor;

        if ($request->input('updatebtnsubmit')) {

            $userInputs = $request->all();
            $this->_set_post_validations($this->requestSlug, $request);
            // $this->_set_file_upload_settings($this->requestSlug, $request);
            // pre($userInputs);

            try {

                $postData = $this->_get_post_data($request);

                $postMetaData = $this->_get_post_meta_data($request);

                DB::beginTransaction();
                $postData = $this->_get_post_data($request);
                $postDetails = PostModel::findorfail($editId);

                foreach ($postData as $key => $val) {
                    $postDetails->{$key} = $val;
                }

                $postDetails->save();

                if (!empty($postMetaData)) {
                    $postDetails->syncMeta($postMetaData);
                }

                //Media Files
                $postMedia = $request->input('postMedia');

                if (!empty($postMedia)) {

                    $updateArr = [];
                    // pre($media);
                    PostMediaModel::where('pm_post_id', '=', $postDetails->post_id)->update(['pm_status' => 3]);
                    // pre($postMedia);
                    foreach ($postMedia as $key => $media) {

                        $temp = ['pm_post_id' => $postDetails->post_id, 'pm_cat' => $key, 'pm_status' => 1];

                        PostMediaModel::whereIn('pm_id', $media)->update($temp);
                    }
                }

                //Tags
                $tags = $request->input('post_tags');

                $finalTags = [];

                $tags = array_map('trim', explode(',', $tags));
                foreach ($tags as $tag) {
                    if (!empty($tag)) {
                        $finalTags[] = $tag;
                    }
                }
                //pre($finalTags);
                $postDetails->retag($finalTags);

                //Child posts
                $postChildrens = $request->input('postChild');
                PostModel::where('post_parent_id', '=', $postDetails->post_id)->delete();
                if (!empty($postChildrens)) {
                    $childPostData = $this->_get_child_post_data($request, $postDetails->post_id);
                    // pre($childPostData);
                    foreach ($childPostData as $childData) {
                        $childPostArr = $childData['post'];

                        $childPostObj = PostModel::create($childPostArr);
                        if (!empty($childData['postMeta'])) {
                            $childPostObj->syncMeta($childData['postMeta']);
                        }
                    }
                }

                DB::commit();

                $this->data['userMessage'] = $this->custom_message($this->slugText . ' saved successfully.', 'success');
            } catch (\Exception $e) {
                $request->flash();
                DB::rollback();

                $message = '<div class="alert alert-danger">Error occured while saving data.' . $e->getMessage() . '</div>';
                if ($e->getCode() == 23000) {
                    $message = '<div class="alert alert-danger">Title already exist, Please enter a different title</div>';
                }
                $this->data['userMessage'] = $message;
            }
        }

        $this->hasParent();

        if (!view()->exists('admin.' . $slug . '.edit')) {
            return View('admin.error.errorpage', $this->data);
        }

        if ($slug == 'banners') {
            $this->data['allPost'] = PostModel::where('post_type', '!=', 'banners')->orderBy('post_created_at')->get()->groupBy(function ($item) {
                return $item->post_type;
            });
        }

        switch ($slug) {

            case "council-members":
                $this->data['council_roles'] = PostModel::where('post_type', 'council-roles')
                    ->where('post_status', 1)
                    ->orderBy('post_priority', 'asc')
                    ->get();
                break;

            case 'our-events':
                $this->data['EventsCategoryList'] = CategoryModel::where('category_parent_id', '=', 24)->active()->get();

                break;
            case 'youtube_gallery':
                $this->data['resourceSubCategoryList'] = CategoryModel::where('category_parent_id', '=', 6)->active()->get();
                break;

            case 'news_and_opinions':
            case 'news-opinion':
                $this->data['NewsCategoryList'] = CategoryModel::where('category_parent_id', '=', 10)->active()->get();
                $this->data['resourceSubCategoryList'] = CategoryModel::where('category_parent_id', '=', 6)->active()->get();

                break;
            case 'resources':
                $this->data['resourceCategoryList'] = CategoryModel::where('category_parent_id', '=', 1)->active()->get();
                $this->data['resourceSubCategoryList'] = CategoryModel::where('category_parent_id', '=', 6)->active()->get();
                break;
            case 'be_an_esafe_kid_article':
                $this->data['CategoryList'] = PostModel::where('post_type', '=', 'be_an_esafe_kid')->active()->get();
                break;
            default:
                $categoryList = CategoryModel::active()->get();
                $this->data['categoryList'] = $categoryList;
                $nestableConfig = $this->_GetCategoryNestableConfig();
                $nestableCategory = NestableCategoryServiceProvider::attr(['class' => 'form-control custom-select', 'name' => 'meta[text][category_id]'])->make($categoryList, $nestableConfig);

                $this->data['categoryDropDown'] = $nestableCategory->renderAsDropdown();
                break;

        }
        $this->data['postDetails'] = Postmodel::find($editId);

        if (empty($this->data['postDetails'])) {
            return redirect()->to(adminPrefix() . 'post_collection/' . $slug)->with('userMessage', 'Invalid Request.');
        }

        /* if($slug=='gallery'){
        $this->data['hasGallery'] = true;
        } */

        $categoryList = CategoryModel::active()->get();
        $this->data['categoryList'] = $categoryList;
        $nestableConfig = $this->_GetCategoryNestableConfig();
        $nestableCategory = NestableCategoryServiceProvider::attr(['class' => 'form-control custom-select', 'name' => 'meta[text][category_id]'])->make($categoryList, $nestableConfig);

        $this->data['categoryDropDown'] = $nestableCategory->selected($this->data['postDetails']->getData('category_id'))->renderAsDropdown();

        // pre($this->data['postDetails']);
        return View('admin.' . $slug . '.edit', $this->data);
    }

    public function changestatus($slug, $postID, $currentStatus, Request $request)
    {
        /*if(!$this->checkPermission('Edit '.$this->module)){
        return redirect()->to(route('admin_dashboard'))->with('userMessage','Invalid Permission') ;
        }*/
        $currentStatus = ($currentStatus == 1) ? 2 : 1;
        $currentStatusdatas = array('post_status' => $currentStatus);
        $postObj = PostModel::where('post_id', '=', $postID)->first();
        $postObj->update($currentStatusdatas);
        $message = '<div class="alert alert-success">Status changed successfully</div>';

        return redirect()->to(route('post_index', ['slug' => $slug, 'page' => $request->input('page'), 'post_title' => $request->input('post_title')]))->with('userMessage', $message);
    }

    public function fileupload(Request $request)
    {

        // $this->_set_file_upload_settings($request->input('slug'),$request);
        if (!$request->file('file')) {
            return response()->json(array('status' => false, 'message' => 'Invalid Request'));
        }

        $file = $request->file('file');
        $slug = $request->input('slug');
        $type = $request->input('controlName');
        if (!empty($this->imageDimensions[$slug]) && $type == "image") {
            $fileName = $this->resize_and_crop_image('file', 'public/post/', $this->imageDimensions[$slug]);
            return response()->json(array('status' => true, 'uploadDetails' => ['fileName' => $fileName]));
        } else {

            list($fileName, $filePath) = $this->store_file('file', 'public/post/');
            return response()->json(array('status' => true, 'uploadDetails' => ['fileName' => $fileName]));
        }

        return response()->json(array('status' => false, 'message' => 'Invalid Request'));
    }

    public function general_filedelete($fileName, Request $request)
    {

        return parent::deleteFile($fileName, $request);
    }

    public function general_filedownload($fileName, Request $request)
    {

        return parent::downloadFile($fileName, $request);
    }

    public function delete($slug, $id, Request $request)
    {

        /* if(!$this->checkPermission('Delete '.$this->module)){
        return redirect()->to(route('admin_dashboard'))->with('userMessage','Invalid Permission') ;
        } */

        //Restrict Banner Deletion
        if (in_array($slug, ['banner'])) {
            return redirect()->to(adminPrefix() . 'dashboard')->with('userMessage', 'Invalid Request.');
        }

        $post = PostModel::find($id);

        $message = $this->custom_message('Error deleting ' . $slug, 'error');
        if (!empty($post)) {
            try {
                DB::beginTransaction();
                if ($slug == 'gallery') {
                    $galleryData = DB::table('gallery_images')
                        ->where('gallery_image_type', '=', 1)
                        ->where('gallery_post_id', '=', $post->post_id)
                        ->get();
                    foreach ($galleryData as $galImage) {
                        if (!empty($galImage->gallery_image_name) && File::exists('storage/app/public/uploads/gallery/' . $galImage->gallery_image_name)) {

                            File::delete('storage/app/public/uploads/gallery/' . $galImage->gallery_image_name);
                            File::delete('storage/app/public/uploads/gallery/thumb/' . $galImage->gallery_image_name);
                            File::delete('storage/app/public/uploads/gallery/small/' . $galImage->gallery_image_name);
                            File::delete('storage/app/public/uploads/gallery/large/' . $galImage->gallery_image_name);

                        }
                    }
                }

                $post->delete();
                DB::commit();
                $message = $this->custom_message($this->slugText . ' deleted Successfully', 'success');
            } catch (\Exception $e) {
                DB::rollback();
                $message = $this->custom_message('Error deleting ' . $this->slugText, 'error');
            }
            // pre(adminPrefix().'post_collection/'.$slug);

            return redirect()->to(apa('post/' . $slug, true))->with('userMessage', $message);
        }
        return redirect()->to(apa('post/' . $slug, true))->with('userMessage', $message);
    }

    public function importPostRecords(Request $request, $slug)
    {
        // Todo - File Request
        if (!empty($request->file('post_import_file'))) {
            $result = Excel::toArray(new GeneralExcelImport(), $request->file('post_import_file'))[0];
            try {
                $index = 1;
                switch ($slug) {
                    case "determination_article":
                        foreach ($result as $item) {

                            //Sif($index==1) continue;

                            if (!empty($item[0])) {
                                $inputs = [
                                    'post_title' => $item[0],
                                    'post_title_arabic' => $item[1],
                                    'post_type' => 'determination_article',
                                    'post_status' => 1,
                                    'post_created_by' => 1,
                                    'post_updated_by' => 1,
                                    'post_priority' => $index,
                                ];

                                $postMetaData = [
                                    'description' => $item[2],
                                    'description_arabic' => $item[3],
                                ];

                                $existingPost = PostModel::where('post_title', '=', $item[0])
                                    ->where('post_title_arabic', '=', $item[1])
                                    ->where('post_type', $slug)
                                    ->first();

                                if (empty($existingPost)) {
                                    $newPost = PostModel::create($inputs);
                                    $newPost->syncMeta($postMetaData);

                                    $finalTags = [];
                                    if (!empty($item[4])) {
                                        $tags = array_map('trim', explode(',', $item[4]));
                                        foreach ($tags as $tag) {
                                            if (!empty($tag)) {
                                                $finalTags[] = $tag;
                                            }
                                        }
                                        $newPost->tag($finalTags);
                                    }

                                } else {
                                    $existingPost->fill($inputs)->save();
                                    $existingPost->syncMeta($postMetaData);
                                }

                                $index++;
                            }
                        }
                        break;
                    case "determination_blog":
                        foreach ($result as $item) {

                            //Sif($index==1) continue;

                            if (!empty($item[0])) {
                                $inputs = [
                                    'post_title' => $item[0],
                                    'post_title_arabic' => $item[1],
                                    'post_type' => 'determination_blog',
                                    'post_status' => 1,
                                    'post_created_by' => 1,
                                    'post_updated_by' => 1,
                                    'post_priority' => $index,
                                ];

                                $postMetaData = [
                                    'description' => $item[2],
                                    'description_arabic' => $item[3],
                                ];

                                $existingPost = PostModel::where('post_title', '=', $item[0])
                                    ->where('post_title_arabic', '=', $item[1])
                                    ->where('post_type', $slug)
                                    ->first();

                                if (empty($existingPost)) {
                                    $newPost = PostModel::create($inputs);
                                    $newPost->syncMeta($postMetaData);

                                    $finalTags = [];
                                    if (!empty($item[4])) {
                                        $tags = array_map('trim', explode(',', $item[4]));
                                        foreach ($tags as $tag) {
                                            if (!empty($tag)) {
                                                $finalTags[] = $tag;
                                            }
                                        }
                                        $newPost->tag($finalTags);
                                    }

                                } else {
                                    $existingPost->fill($inputs)->save();
                                    $existingPost->syncMeta($postMetaData);
                                }

                                $index++;
                            }
                        }
                        break;
                    case "young_people_article":
                        foreach ($result as $item) {

                            //Sif($index==1) continue;

                            if (!empty($item[0])) {
                                $inputs = [
                                    'post_title' => $item[0],
                                    'post_title_arabic' => $item[1],
                                    'post_type' => 'young_people_article',
                                    'post_status' => 1,
                                    'post_created_by' => 1,
                                    'post_updated_by' => 1,
                                    'post_priority' => $index,
                                ];

                                $postMetaData = [
                                    'description' => $item[2],
                                    'description_arabic' => $item[3],
                                ];

                                $existingPost = PostModel::where('post_title', '=', $item[0])
                                    ->where('post_title_arabic', '=', $item[1])
                                    ->where('post_type', $slug)
                                    ->first();

                                if (empty($existingPost)) {
                                    $newPost = PostModel::create($inputs);
                                    $newPost->syncMeta($postMetaData);

                                    $finalTags = [];
                                    if (!empty($item[4])) {
                                        $tags = array_map('trim', explode(',', $item[4]));
                                        foreach ($tags as $tag) {
                                            if (!empty($tag)) {
                                                $finalTags[] = $tag;
                                            }
                                        }
                                        $newPost->tag($finalTags);
                                    }

                                } else {
                                    $existingPost->fill($inputs)->save();
                                    $existingPost->syncMeta($postMetaData);
                                }

                                $index++;
                            }
                        }
                        break;
                    case "young_people_blog":
                        foreach ($result as $item) {

                            //Sif($index==1) continue;

                            if (!empty($item[0])) {
                                $inputs = [
                                    'post_title' => $item[0],
                                    'post_title_arabic' => $item[1],
                                    'post_type' => 'young_people_blog',
                                    'post_status' => 1,
                                    'post_created_by' => 1,
                                    'post_updated_by' => 1,
                                    'post_priority' => $index,
                                ];

                                $postMetaData = [
                                    'description' => $item[2],
                                    'description_arabic' => $item[3],
                                ];

                                $existingPost = PostModel::where('post_title', '=', $item[0])
                                    ->where('post_title_arabic', '=', $item[1])
                                    ->where('post_type', $slug)
                                    ->first();

                                if (empty($existingPost)) {
                                    $newPost = PostModel::create($inputs);
                                    $newPost->syncMeta($postMetaData);

                                    $finalTags = [];
                                    if (!empty($item[4])) {
                                        $tags = array_map('trim', explode(',', $item[4]));
                                        foreach ($tags as $tag) {
                                            if (!empty($tag)) {
                                                $finalTags[] = $tag;
                                            }
                                        }
                                        $newPost->tag($finalTags);
                                    }

                                } else {
                                    $existingPost->fill($inputs)->save();
                                    $existingPost->syncMeta($postMetaData);
                                }

                                $index++;
                            }
                        }
                        break;
                    case "be_an_esafe_kid":
                        foreach ($result as $item) {

                            //Sif($index==1) continue;

                            if (!empty($item[0])) {
                                $inputs = [
                                    'post_title' => $item[0],
                                    'post_title_arabic' => $item[1],
                                    'post_type' => 'be_an_esafe_kid',
                                    'post_status' => 1,
                                    'post_created_by' => 1,
                                    'post_updated_by' => 1,
                                    'post_priority' => $index,
                                ];

                                $existingPost = PostModel::where('post_title', '=', $item[0])
                                    ->where('post_title_arabic', '=', $item[1])
                                    ->where('post_type', $slug)
                                    ->first();

                                if (empty($existingPost)) {
                                    $newPost = PostModel::create($inputs);
                                    //$newPost->syncMeta($postMetaData);

                                } else {
                                    $existingPost->fill($inputs)->save();
                                    //$existingPost->syncMeta($postMetaData);
                                }

                                $index++;
                            }
                        }
                        break;
                    case "be_an_esafe_kid_article":
                        foreach ($result as $item) {

                            //Sif($index==1) continue;

                            if (!empty($item[0])) {
                                $inputs = [
                                    'post_title' => $item[0],
                                    'post_title_arabic' => $item[1],
                                    'post_type' => 'be_an_esafe_kid_article',
                                    'post_status' => 1,
                                    'post_created_by' => 1,
                                    'post_updated_by' => 1,
                                    'post_priority' => $index,
                                ];

                                // fetch category
                                $esafe_category_id = "";
                                $categoryPost = PostModel::where('post_title', '=', $item[2])
                                    ->where('post_type', 'be_an_esafe_kid')
                                    ->first();
                                if ($categoryPost) {
                                    $esafe_category_id = $categoryPost->post_id;
                                }

                                $postMetaData = [
                                    'esafe_category_id' => $esafe_category_id,
                                    'esafe_kid_heading1' => $item[3],
                                    'esafe_kid_heading1_arabic' => $item[4],
                                    'esafe_kid_description1' => $item[5],
                                    'esafe_kid_description1_arabic' => $item[6],
                                    'esafe_kid_heading2' => $item[7],
                                    'esafe_kid_heading2_arabic' => $item[8],
                                    'esafe_kid_description2' => $item[9],
                                    'esafe_kid_description2_arabic' => $item[10],
                                ];

                                $existingPost = PostModel::where('post_title', '=', $item[0])
                                    ->where('post_title_arabic', '=', $item[1])
                                    ->where('post_type', $slug)
                                    ->first();

                                if (empty($existingPost)) {
                                    $newPost = PostModel::create($inputs);
                                    $newPost->syncMeta($postMetaData);

                                    $finalTags = [];
                                    if (!empty($item[4])) {
                                        $tags = array_map('trim', explode(',', $item[4]));
                                        foreach ($tags as $tag) {
                                            if (!empty($tag)) {
                                                $finalTags[] = $tag;
                                            }
                                        }
                                        $newPost->tag($finalTags);
                                    }

                                } else {
                                    $existingPost->fill($inputs)->save();
                                    $existingPost->syncMeta($postMetaData);
                                }

                                $index++;
                            }
                        }
                        break;
                    case "i_want_help_with_article":
                        foreach ($result as $item) {

                            //Sif($index==1) continue;

                            if (!empty($item[0])) {
                                $inputs = [
                                    'post_title' => $item[0],
                                    'post_title_arabic' => $item[1],
                                    'post_type' => 'i_want_help_with_article',
                                    'post_status' => 1,
                                    'post_created_by' => 1,
                                    'post_updated_by' => 1,
                                    'post_priority' => $index,
                                ];

                                $postMetaData = [
                                    'help_with_desc_heading' => $item[2],
                                    'help_with_desc_heading_arabic' => $item[3],
                                    'description' => $item[4],
                                    'description_arabic' => $item[5],
                                    'help_with_step_heading' => $item[6],
                                    'help_with_step_heading_arabic' => $item[7],
                                    'help_with_step1' => $item[8],
                                    'help_with_step1_arabic' => $item[9],
                                    'help_with_step2' => $item[10],
                                    'help_with_step2_arabic' => $item[11],
                                    'help_with_step3' => $item[12],
                                    'help_with_step3_arabic' => $item[13],
                                    'help_with_step4' => $item[14],
                                    'help_with_step4_arabic' => $item[15],
                                    'help_with_step5' => $item[16],
                                    'help_with_step5_arabic' => $item[17],
                                    'help_with_step6' => $item[18],
                                    'help_with_step6_arabic' => $item[19],
                                    'help_with_step7' => $item[20],
                                    'help_with_step7_arabic' => $item[21],
                                    'help_with_step8' => $item[22],
                                    'help_with_step8_arabic' => $item[23],
                                    'help_with_step9' => $item[24],
                                    'help_with_step9_arabic' => $item[25],
                                    'help_with_step10' => $item[26],
                                    'help_with_step10_arabic' => $item[27],

                                ];

                                $existingPost = PostModel::where('post_title', '=', $item[0])
                                    ->where('post_title_arabic', '=', $item[1])
                                    ->where('post_type', $slug)
                                    ->first();

                                if (empty($existingPost)) {
                                    $newPost = PostModel::create($inputs);
                                    $newPost->syncMeta($postMetaData);

                                } else {
                                    $existingPost->fill($inputs)->save();
                                    $existingPost->syncMeta($postMetaData);
                                }

                                $index++;
                            }
                        }
                        break;
                    case "report_question":
                        foreach ($result as $item) {

                            //Sif($index==1) continue;

                            if (!empty($item[0])) {
                                $inputs = [
                                    'post_title' => $item[0],
                                    'post_title_arabic' => $item[1],
                                    'post_type' => 'report_question',
                                    'post_status' => 1,
                                    'post_created_by' => 1,
                                    'post_updated_by' => 1,
                                    'post_priority' => $index,
                                ];

                                $postMetaData = [
                                    'report_question_option1' => $item[2],
                                    'report_question_option1_arabic' => $item[3],
                                    'report_question_option2' => $item[4],
                                    'report_question_option2_arabic' => $item[5],
                                    'report_question_option3' => $item[6],
                                    'report_question_option3_arabic' => $item[7],
                                    'report_question_option4' => $item[8],
                                    'report_question_option4_arabic' => $item[9],
                                    'report_question_option5' => $item[10],
                                    'report_question_option5_arabic' => $item[11],
                                ];

                                $existingPost = PostModel::where('post_title', '=', $item[0])
                                    ->where('post_title_arabic', '=', $item[1])
                                    ->where('post_type', $slug)
                                    ->first();

                                if (empty($existingPost)) {
                                    $newPost = PostModel::create($inputs);
                                    $newPost->syncMeta($postMetaData);

                                } else {
                                    $existingPost->fill($inputs)->save();
                                    $existingPost->syncMeta($postMetaData);
                                }

                                $index++;
                            }
                        }
                        break;

                }

            } catch (\Exception $ex) {
                DB::rollback();
                dd("error: " . $ex->getMessage());
            }
            return redirect()->back()->with('userMessage', "Updated");
        }
    }

}
