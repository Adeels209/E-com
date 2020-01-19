<?php

namespace Modules\Admin\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\CreateUserRequest;
use Spatie\Permission\Models\Role;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        $this->middleware(['auth:admin','isAdmin']);
    }

    public function index()
    {
        $admins = Admin::all();
        return view('admin::user.index', compact('roles','admins'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin::user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
//        return $request->all();
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();
        $roles = $request->role;
        if(isset($roles)) {
            foreach ($roles as $role) {
                $rolez = Role::where('id', $role)->firstOrFail();
                $admin->assignRole($rolez);
            }
        }
        return back();
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $rolez = Role::all();
        return view('admin::user.edit', compact('admin','rolez'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
//        return $request->all();
        $user = Admin::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $roles = $request->role;
        $user->save();
        if (isset($roles)) {
            $user->roles()->sync($roles);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $user = Admin::findOrFail($request->id);
        $role = Role::all();
        foreach($role as $srole)
        $user->removeRole($srole);
        if($user->delete()){
            return response()->json(['status'=>200]);
        } else {
            return response()->json(['status'=>-1]);
        }

    }
}
