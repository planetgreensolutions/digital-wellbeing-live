<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Base\AdminBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\PermissionRegistrar;
use Config;
use App\User;

class RolesController extends AdminBaseController{
	
	protected $roleName;
	
    public function __construct(Request $request){

		 parent::__construct($request);
		$this->module = 'Role';
	}
	


    public function index(Request $request)
    {
        if(!$this->checkPermission('List')){
			return $this->returnInvalidPermission($request);
		}
		
        $this->data['roles'] = Role::all();

        return view('admin.roles.index', $this->data);
    }

    /**
     * Show the form for creating new Role.
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
                $role = Role::create($request->except('permission'));
                $permissions = $request->input('permission') ? $request->input('permission') : [];
                $role->givePermissionTo($permissions);
				$message = '<div class="alert alert-success">Role created.</div>';
            }catch(RoleAlreadyExists $e){
               $message = '<div class="alert alert-danger">Cannot save role. This role already exist!!!</div>';
            }
			return Redirect(apa('roles/create'))->with('userMessage',$message);
        }
       


        $this->data['permissions'] = Permission::get()->pluck('name', 'name');

        return view('admin.roles.create',  $this->data);
    }

  

    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id ,  Request $request)
    {
		if(!$this->checkPermission('Edit')){
			return $this->returnInvalidPermission($request);
		}
        
       if($request->isMethod('post')){
            try{
                $role = Role::findOrFail($id);
                $role->update($request->except('permission'));
                $permissions = $request->input('permission') ? $request->input('permission') : [];
                $role->syncPermissions($permissions);
				$message = '<div class="alert alert-success">Role updated.</div>';
            }catch(RoleAlreadyExists $e){
               $this->data['errorMessage'] = 'Cannot update role. This role already exist!!!';
			    $message = '<div class="alert alert-danger">Cannot save role. This role already exist!!!</div>';
            }
			return Redirect(apa('roles/edit/'.$id))->with('userMessage',$message);
        } 
         
       
        $this->data['user'] = User::find(\Auth::user()->id); //Get user with specified id
        
        // $this->data['roles'] = Role::get(); //Get all roles
        
        $this->data['permissions'] = Permission::get()->pluck( 'name', 'name')->toArray();

        $this->data['role'] = Role::findOrFail($id);
        $rolePermissions =  $this->data['role']->permissions()->pluck('name', 'name');
        $this->data['rolePermissions'] = array('-1');
        foreach($rolePermissions as $role){
            $this->data['rolePermissions'][] = $role;
        }
        natsort( $this->data['rolePermissions']);
         natsort( $this->data['permissions']);
        return view('admin.roles.edit',  $this->data);
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request,$id)
    {
		if(!$this->checkPermission('Delete')){
			return $this->returnInvalidPermission($request);
		}	
        $role = Role::findOrFail($id);
        $role->delete();
		$message = '<div class="alert alert-success">Role deleted.</div>';
        return redirect()->to(Config::get('app.admin_prefix').'/roles')->with('userMessage',$message);
    }

   

}
