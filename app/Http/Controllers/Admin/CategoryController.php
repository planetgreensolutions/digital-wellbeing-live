<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Base\AdminBaseController;
use App\User as User;

use Illuminate\Http\Request;
use Carbon\Carbon; // Date formatting class
use Illuminate\Support\Facades\Storage;

use Nestable;
use App\Providers\NestableCategoryServiceProvider;
use App\Models\CategoryModel;

class CategoryController extends AdminBaseController{


	public function __construct(Request $request){
		parent::__construct($request);
	}
	
	
	
	public function index(){
		
		$categoryList = CategoryModel::orderBy('category_priority','asc')->active()->get();
		//dd($categoryList->toArray());
		$this->data['categoryList'] = $categoryList;
		$nestableConfig = $this->_GetCategoryNestableConfig();
		$nestableCategory = NestableCategoryServiceProvider::attr(['class'=>'form-control','name'=>'category_parent_id'])->make($categoryList, $nestableConfig);
		
		$this->data['categoryTree'] = $nestableCategory->renderAsHtml();
		
		// dd($this->data['categoryTree']);
		
		return view('admin.category.list',$this->data);
	}

	public function create(Request $request){

		if( $request->input('createbtnsubmit') && $request->isMethod('post') ){
				$this->validate($request, [
				  'category_title' => 'required',
				  'category_title_arabic' => 'required',
				//   'category_parent_id' => 'required',
				]);


				$arr = array(
						'category_title'=>$request->input('category_title'),
						'category_title_arabic'=>$request->input('category_title_arabic'),
						'category_parent_id'=>$request->input('category_parent_id'),
						'category_description'=>$request->input('category_description'),
						'category_image'=>$request->input('cat_image'),
						'category_priority'=>$request->input('category_priority'),
						'category_created_by'=>\Auth::user()->id,
						'category_updated_by'=>\Auth::user()->id,
						'category_status'=>$request->input('category_status')
				);
                
                $iconImage = $request->file('category_category_iconimage');
                
				if($iconImage){
                     $filePath = 'public/uploads/category/icon';
					 list($fileName, $fileNameWithPath) = $this->store_file('category_icon', 'public/uploads/category/icon');
                     $arr['category_icon'] = $fileName;
                }

                $mainImage = $request->file('category_image');
                
				if($mainImage){
                     $filePath = 'public/uploads/category/image';
					 list($fileName, $fileNameWithPath) = $this->store_file('category_image', 'public/uploads/category/image');
                     $arr['category_image'] = $fileName;
                }
                
				$category = CategoryModel::create($arr);

				return back()->with('success','Category saved successfully.');

            }
            // pre(CategoryModel::nested()->get());
         //$this->data['categoryList'] = CategoryModel::attr(['name' => 'category_parent_id'])
                                       // ->renderAsDropdown();
		 $categoryList = CategoryModel::active()->get();
		 $this->data['categoryList'] = $categoryList;
		 $nestableConfig = $this->_GetCategoryNestableConfig();
		 $nestableCategory = Nestable::attr(['class'=>'form-control','name'=>'category_parent_id'])->make($categoryList, $nestableConfig);

		 $this->data['categoryDropDownHTML'] = $nestableCategory->renderAsDropdown();
		 
		 return view('admin.category.add',$this->data);
	}

	public function update($editID, Request $request){
        
		if(empty($editID)) { return redirect()->to(apa('category_manager'));}
        
		$this->data['messages']	='';

		if($request->input('_token')){
            // pre($request->all());
			$this->validate($request, [
				'category_title' => 'required',
				'category_title_arabic' => 'required',
			]);


			
			$category  = CategoryModel::find($editID);
			
			$iconImage = $request->file('category_category_iconimage');
			
			if($iconImage){
				$filePath = 'public/uploads/category/image';
				list($fileName, $fileNameWithPath) = $this->store_file('category_icon', 'public/uploads/category/icon');
				$category->category_icon = $fileName;
			}

			$mainImage = $request->file('category_image');
			
			if($mainImage){
				$filePath = 'public/uploads/category/image';
				list($fileName, $fileNameWithPath) = $this->store_file('category_image', 'public/uploads/category/image');
				$category->category_image = $fileName;
			}	
			
		
		
		if(empty($category)){
			return back()->with('userMessage','No such category found.');
		}
		
		$category->category_title = $request->input('category_title');
		$category->category_title_arabic = $request->input('category_title_arabic');
		$category->category_parent_id = $request->input('category_parent_id');
		$category->category_image = $request->input('cat_image');
		$category->category_created_by = \Auth::user()->id;
		$category->category_updated_by = \Auth::user()->id;
		$category->category_status = $request->input('category_status');
		$category->category_priority = $request->input('category_priority');
		$category->category_slug = null;
		
		$category->save();

		return back()->with('userMessage','Category updated successfully.');
    }


        $this->data['categoryDetails'] = CategoryModel::find($editID);
		if(empty($this->data['categoryDetails'])){
			return redirect()->to(apa('dashboard'))->with('errorMessage',lang('invalid_request'));
		}
		// pre( $this->data['categoryDetails']);
		$categoryList = CategoryModel::active()->get();
		$this->data['categoryList'] = $categoryList;
		$nestableConfig = $this->_GetCategoryNestableConfig();
        $nestableCategory = Nestable::attr(['class'=>'form-control','name'=>'category_parent_id'])->make($categoryList, $nestableConfig);
		$this->data['categoryDropDownHTML'] = $nestableCategory->selected($this->data['categoryDetails']->category_parent_id)->renderAsDropdown();
		
		
		
        return view('admin.category.edit',$this->data);
	}

	public function changestatus($categoryID){
        $categoryDetails = CategoryModel::find($categoryID);
        // pre($categoryDetails);
		if(empty($categoryDetails)) { return redirect()->to(apa('category_manager'))->with('success','Record not found');}
		$currentStatus = ( $categoryDetails->category_status == 2 )? 1 : 2 ;
        $currentStatusdatas = array("category_status"=>$currentStatus);
        $details = CategoryModel::where('category_id','=',$categoryID)->update($currentStatusdatas);
        $categoryDetails = CategoryModel::find($categoryID);
		 return redirect()->to(apa('category_manager'))->with('success','Status changed');
	}

	public function delete($deleteID){
		if(empty($deleteID)) { return redirect()->to(apa('category_manager'));}
		CategoryModel::where('category_id','=',$deleteID)->delete();
		return redirect()->to(apa('category_manager'))->with('userMessage','Record deleted');
    } 

}
