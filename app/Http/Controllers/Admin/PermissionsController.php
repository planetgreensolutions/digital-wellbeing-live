<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Base\AdminBaseController;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Gate;
// use App\Http\Controllers\Controller;
// use App\Http\Requests\Admin\StorePermissionsRequest;
// use App\Http\Requests\Admin\UpdatePermissionsRequest;
use Carbon\Carbon; // Date formatting class
use Illuminate\Support\Facades\Storage;
use Config;

use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\PermissionRegistrar;


class PermissionsController extends AdminBaseController{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
   public function __construct(Request $request){

		 parent::__construct($request);
		 $this->module = 'Permission';
   }

    public function index(Request $request)
    {
        if(!$this->checkPermission('List')){
			return $this->returnInvalidPermission($request);
		}
        $this->data['permissions'] = Permission::orderBy('name','ASC')->get();
      
        return view('admin.permissions.index', $this->data);
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		if(!$this->checkPermission('Add')){
			return $this->returnInvalidPermission($request);
		}
        if($request->isMethod('post')){
            try{
                Permission::create($request->all());
				$message = '<div class="alert alert-success">Permission created.</div>';
            }catch(PermissionAlreadyExists $e){
			   $message = '<div class="alert alert-danger">Cannot save permission. This permission already exist!!!</div>';
            }
			return Redirect(apa('permissions/create'))->with('userMessage',$message);
        }

        return view('admin.permissions.create',$this->data);
    }

    


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        if(!$this->checkPermission('Edit')){
			return $this->returnInvalidPermission($request);
		}
        if($request->isMethod('post')){
            try{
                $permission = Permission::findOrFail($id);
                $permission->update($request->all());
				$message = '<div class="alert alert-success">Permission updated.</div>';
            }catch(PermissionAlreadyExists $e){
                 $message = '<div class="alert alert-danger">Cannot save permission. This permission already exist!!!</div>';
            }
			return Redirect(apa('permissions/edit/'.$id))->with('userMessage',$message);
        }
       

        $this->data['permission'] = Permission::findOrFail($id);

        return view('admin.permissions.edit', $this->data);
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
		if(!$this->checkPermission('Edit')){
			return $this->returnInvalidPermission($request);
		}
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());

       return redirect()->to(Config::get('app.admin_prefix').'/permissions/edit/'.$id)->with('userMessage','Permission deleted');
    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request,$id)
    {
        if(!$this->checkPermission('Delete')){
			return $this->returnInvalidPermission($request);
		}
        $permission = Permission::findOrFail($id);
        $permission->delete();
		$userMessage = '<div class="alert alert-success">Permission deleted</div>';
        return redirect()->to(Config::get('app.admin_prefix').'/permissions')->with('userMessage',$userMessage);
    }

    /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     */
    private function massDestroy(Request $request)
    {
        /* if (! Gate::allows('Manage Permissions')) {
            return redirect()->to(Config::get('app.admin_prefix').'/dashboard')->with('errorMessage','Invalid request. Insufficient privileges');
        } */

        if ($request->input('ids')) {
            $entries = Permission::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
