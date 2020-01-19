<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use Modules\Admin\Http\Requests\CreateUserRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        $this->middleware(['auth:admin', 'isAdmin']);
    }

    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin::role.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */

    public function create()
    {
        $permissions = Permission::all();
        return view('admin::role.create', compact('permissions'));
    }


    public function store(Request $request)
    {
//        return $request->all();
        $name = $request->name;
        $role = new Role();
        $role->name = $name;
        $permissions  = $request->permissions;
        $role->save();
        foreach($permissions as $permission){
            $permissionz = Permission::where('id', $permission)->firstOrFail();
            $role = Role::where('name', $name)->first();
            $role->givePermissionTo($permissionz);
        }
        return back();
    }
    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissionz = Permission::all();
        return view('admin::role.edit', compact('role','permissionz'));

    }

    public function update(CreateUserRequest $request, $id)
    {
//        $input = $request->all();
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->update();
        $permissions = $request->permissions;

        $permissionsAll = Permission::all();
        foreach($permissionsAll as $permissionall){
            $role->revokePermissionTo($permissionall);
        }
        foreach($permissions as $permission){
            $permissionAssigned = Permission::where('id',$permission)->firstOrFail();
            $role->givePermissionTo($permissionAssigned);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $role = Role::findOrFail($request->id);
        $permissions = Permission::all();
        foreach($permissions as $permission) {
            $role->revokePermissionTo($permission);
        }
        if($role->delete()){
            return response()->json(['status'=>200]);
        } else {
            return response()->json(['status'=>-1]);
        }

    }
}
