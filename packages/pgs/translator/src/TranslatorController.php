<?php
namespace Pgs\Translator;

use App\Http\Controllers\Admin\Base\AdminBaseController;
use App\Http\Controllers\Controller;
use Validator, Input,Config,DB;
use App\User as User;
use Illuminate\Http\Request;
use Pgs\Translator\TranslatorModel;
use Pgs\Translator\TranslationLanguageModels;
use Intervention\Image\Exception\NotReadableException;
use File;

class TranslatorController extends AdminBaseController {


	public function __construct(Request $request){

		// $this->is_admin_login();
		$this->data['hasPluploader'] = false;
		$this->data['hasTextEditor'] = false;
		parent::__construct($request);

	}

	
	public function index(Request $request){
		// die;
		$this->data['languages'] = TranslationLanguageModels::all();
		$translationModel = TranslatorModel::orderBy('item','asc');
		if($request->input('search')){
			if($request->input('search_type')){
				$translationModel->where('group','=',$request->input('search_type'));
			}
			
			if($request->input('search_locale')){
				$translationModel->where('locale','=',$request->input('search_locale'));
			}
			
			if($request->input('search_key')){
				$translationModel->where('item','=',$request->input('search_key'));
			}
			
			if($request->input('search_text')){
				$translationModel->where('text','LIKE','%'.$request->input('search_text').'%');
			}
		}
		$this->data['translations'] = $translationModel->paginate(15)->appends(\Input::except('page'));
		return view('pgs.translator.list',$this->data);
		
	}
	
	public function create(Request $request){
		
		$this->data['languages'] = TranslationLanguageModels::all();
		if($request->input('createbtnsubmit')){
			$inputs = [
				'key' => $request->input('key'),
				'text' => $request->input('text'),
				'type' => $request->input('type'),
			];
			
			$rules = [
				'key' => 'required',
				'text' => 'required',
				'type' => 'required',
			];
			
			$messages = [
				'key.required' => 'Translation Key is required',
				'text' => 'Translation Text is required',
				'type' => 'Translation Type is required',
			];
			
			$validator = \Validator::make($inputs, $rules, $messages);
			
			if($validator->fails()){
				
				$messages = $validator->messages()->all();
				$userMessage = '<ul class="alert alert-danger">';
				foreach($messages as $message){
					$userMessage = '<li>'.$message.'</li>';	
				}
				$userMessage = '</ul>';
				$request->flash();
				return Redirect(route('create_translation'))->with('userMessage',$userMessage);
				
			}else{
				$dataArr = [];
				$userMessage = '<div class="">';
				foreach($inputs['text'] as $locale => $langtext){
					if($langtext){
						$data = [];
						$data['locale'] = $locale;
						$data['namespace'] = '*';
						$data['group'] = $inputs['type'];
						$data['item'] = $inputs['key'];
						$data['text'] = $langtext;
						try{
							TranslatorModel::create($data);
							$userMessage .= '<div class="alert alert-success">Translation Created for '.$locale.' The Text is : '.$langtext.'</div>';
						}catch(\Exception $e){
							$userMessage .= '<div class="alert alert-danger">Translation Exists for '.$locale.' The Text is : '.$langtext.'</div>';
						}
					}else{
						$request->flash();
						$userMessage .= '<div class="alert alert-info">Nothing to create for : '.$locale.'</div>';
					}
				}
				$userMessage .= '</div>';
				return Redirect(route('create_translation'))->with('userMessage',$userMessage);
				
			}
		}
		return view('pgs.translator.add',$this->data);
	}

	public function update(Request $request){
		$id = $request->input('id');
		$value = $request->input('value');
		$response = ['status'=>false];
		if(!empty($id) &&  !empty($value)){
			$model = TranslatorModel::find($id);
			if(!empty($model)){
				$model->update(['text'=>$value]);
				$model->save();
				$response = ['status'=>true];
			}
			
		}
		return response()->json($response);
	}

	public function delete(Request $request , $id){
		
		$translation = TranslatorModel::find($id);
		$userMessage = '<div class="alert alert-success">Translation Deleted Successfully</div>';

		if(empty($translation)){
			$userMessage = '<div class="alert alert-danger">Error , No Record found.</div>';
			return redirect()->to(route('translate_index'))->with('userMessage',$userMessage);
		}

		$translation->delete();
		return redirect()->to(route('translate_index'))->with('userMessage',$userMessage);
	 }
	
}