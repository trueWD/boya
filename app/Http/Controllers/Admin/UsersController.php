<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Hash;
use App\User;
use App\Models\Depo01;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use App\Http\Requests\Admin\UpdatePasswordRequest;

class UsersController extends Controller
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

        $users = User::with('depo01')->get();
        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.index', compact('users','roles'));
    }


    /*
    _____________________________________________________________________________________________
    Store
    _____________________________________________________________________________________________
    */

    public function store(StoreUsersRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $user       = User::create($request->all());
        $roles      = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);

        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kullanıcı Kayıt edildi',
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
        $user   = User::findOrFail($request->id);
        $user->delete();

        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kullanıcı Silindi',
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

       // dd($request->all());

        $user               = User::with('depo01')->findOrFail($request->id);
        $roles              = Role::get()->pluck('name', 'name');
        $depo01             = Depo01::all();
        $data['edituser']   = view('admin.users.edit',['user' => $user,'roles' => $roles, 'depo01' => $depo01])->render();


        return response()->json($data);
    }

    /*
    _____________________________________________________________________________________________
    Update
    _____________________________________________________________________________________________
    */
    public function update(UpdateUsersRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $user   = User::findOrFail($request->id);
        $user->update($request->all());
        if($request->input('roles') !=NULL){
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->syncRoles($roles);
        }


        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kullanıcı Bilgisi Güncellendi',
            'type'  => 'success',
          ];

        return response()->json($data);
    }

    /*
    _____________________________________________________________________________________________
    Sidebar Settings
    _____________________________________________________________________________________________
    */

    public function sidebarClose(Request $request){

        // G Geniş Menü, D Dar Side bar
        $user   = User::findOrFail($request->id);
        if($user->menutipi == "D"){
            $user->menutipi   = 'G';
        }else{
            $user->menutipi   = 'D';
        }
        $user->update();

    }
    /*
    _____________________________________________________________________________________________
    User Settings
    _____________________________________________________________________________________________
    */

    public function usersettings(){

        $users = User::all();
        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.usersettings', compact('users','roles'));

    }
    /*
    _____________________________________________________________________________________________
    Change Password
    _____________________________________________________________________________________________
    */
    public function changepassword(UpdatePasswordRequest $request)
    {
        $user = Auth::getUser();
        if (Hash::check($request->get('current_password'), $user->password)) {
            $user->password = $request->get('new_password');
            $user->save();
            $data =[
                'title' => 'Başarılı!',
                'text'  => 'Kullanıcı Bilgisi Güncellendi',
                'type'  => 'success',
            ];

            return response()->json($data);
        } else {
            
            $data =[
                'title' => 'Hata',
                'text'  => 'Mevcut şifreniz hatalı!..',
                'type'  => 'error',
            ];
            return response()->json($data);
        }
    }

    /*
    _____________________________________________________________________________________________
    Update
    _____________________________________________________________________________________________
    */
    public function userSettingsUpdate(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        //dd($request->id);
        $user   = User::findOrFail($request->id);
        $user->theme = $request->theme;
        $user->menutipi = $request->menutipi;
        $user->update();

        $data =[
            'title' => 'Başarılı!',
            'text'  => 'Kullanıcı Bilgisi Güncellendi',
            'type'  => 'success',
          ];

        return response()->json($data);
    }



}
