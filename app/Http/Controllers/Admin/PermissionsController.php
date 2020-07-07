<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsRequest;
use App\Http\Requests\Admin\UpdatePermissionsRequest;

class PermissionsController extends Controller
{
    /*
    _____________________________________________________________________________________________
    index
    _____________________________________________________________________________________________
    */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }
    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */
    public function store(StorePermissionsRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        Permission::create($request->all());

        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kayıt Başarılı',
            'type'  => 'success',
        ];

        return response()->json($data);
    }


    /*
    _____________________________________________________________________________________________
    Edit
    _____________________________________________________________________________________________
    */
    public function edit(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $permission         = Permission::findOrFail($request->id);
        $data['EditPermissions']   = view('admin.permissions.edit',['permission' => $permission])->render();

        return response()->json($data);

    }

    /*
    _____________________________________________________________________________________________
    Update
    _____________________________________________________________________________________________
    */
    public function update(UpdatePermissionsRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $permission   = Permission::findOrFail($request->id);
        $permission->update($request->all());

               $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kayıt Güncellendi',
            'type'  => 'success',
        ];

        return response()->json($data);
    }


    /*
    _____________________________________________________________________________________________
    Delete 
    _____________________________________________________________________________________________
    */
    public function destroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $permission   = Permission::findOrFail($request->id);
        $permission->delete();

        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kayıt Silindi',
            'type'  => 'success',
        ];

        return response()->json($data);
    }

    public function show(Permission $permission)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        return view('admin.permissions.show', compact('permission'));
    }



}
