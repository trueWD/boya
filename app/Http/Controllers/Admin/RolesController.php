<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;

class RolesController extends Controller
{
    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function index()
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $roles = Role::all();
        $permissions = Permission::get()->pluck('name', 'name');

        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store(StoreRolesRequest $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $role = Role::create($request->except('permissions'));

        $permissions = $request->input('permissions')
            ? $request->input('permissions')
            : [];

        $role->givePermissionTo($permissions);

        $data = [
            'title' => 'Başarılı!',
            'text' => 'Kayıt Başarılı',
            'type' => 'success',
        ];

        return response()
            ->json($data);
    }

    /*
    _____________________________________________________________________________________________
    Edit
    _____________________________________________________________________________________________
    */
    public function edit(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $role = Role::findOrFail($request->id);
        $permissions = Permission::get()->pluck('name', 'name');

        $data['EditRole'] = view('admin.roles.edit', ['permissions' => $permissions, 'role' => $role, ])->render();

        return response()->json($data);
    }

    /*
    _____________________________________________________________________________________________
    Update
    _____________________________________________________________________________________________
    */
    public function update(UpdateRolesRequest $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $role = Role::findOrFail($request->id);
        $role->update($request->except('permission'));


        // $permissions = $request->input('permission') ? $request->input('permission') : [];
        // $role->syncPermissions($permissions);

        $data = [
            'title' => 'Başarılı!',
            'text' => 'Kayıt Güncellendi',
            'type' => 'success',
        ];

        return response()->json($data);
    }

    /*
    _____________________________________________________________________________________________
    Show
    _____________________________________________________________________________________________
    */

    public function show(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $role = Role::findOrFail($request->id);
        //$role->load('permissions');
        $permissions = Permission::all();

        $data['RolePermissions'] = view('admin.roles.show', ['permissions' => $permissions, 'role' => $role, ])->render();

        return response()->json($data);
    }

    /*
    _____________________________________________________________________________________________
    Delete
    _____________________________________________________________________________________________
    */

    public function destroy(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $role = Role::findOrFail($request->id);
        $role->delete();

        $data = [
            'title' => 'Başarılı!',
            'text' => 'Kullanıcı Silindi',
            'type' => 'success',
        ];

        return response()->json($data);
    }

    /*
    _____________________________________________________________________________________________
    Role Permissions
    _____________________________________________________________________________________________
    */

    public function changePermission(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $role = Role::findOrFail($request->roleId);
        $permission = Permission::findOrFail($request->permissionId);

        if ($role->hasPermissionTo($permission)) {
           
           
         /* önceki  
            $role
                ->permissions()
                ->detach($permission); 
        */

            $role->revokePermissionTo($permission);
            $permission->removeRole($role);

        } else {
            $role
                ->givePermissionTo($permission);
        }
        

        $data = [
            'title' => 'Başarılı!',
            'text' => 'Kullanıcı Silindi',
            'type' => 'success',
        ];

        return response()
            ->json($data);
    }
}
