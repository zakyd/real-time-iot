<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserRequest;
use Session;

class UserController extends Controller
{
    public function auth(Request $request)
    {
        $user = User::where('username', '=', $request->username)->first();
        if ($user['username']==$request->username && $user['password']==$request->password) {
            session(['username' => $request->username]);
            return redirect('/view-users');
        }else{
            return redirect('/login');
        }
    }
    public function logout() {
        Session::flush();
        return redirect('/login');
    }
    public function create(Request $request)
    {
        $data['role'] = Role::all();
        return view('createuser',$data);
    }
    public function save(UserRequest $request){
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->gender = $request->gender;
        $user->role_id = $request->role;
        $user->address = $request->address;
        $user->save();
        return redirect('/view-users');
    }
    public function view(Request $request)
    {
        $data['user'] = User::all();
        $data['role'] = Role::all();
        return view('viewusers',$data);
    }
    public function delete(Request $request){
        User::destroy($request->_id);
        return redirect('/view-users');
    }
    public function edit(Request $request){
        $data['user'] = User::find($request->_id);
        $data['role'] = Role::all();
        return view('edituser',$data);
    }
    public function update(UserRequest $request)
    {
        $user = User::where('_id', '=', $request->_id)->first();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->gender = $request->gender;
        $user->role_id = $request->role;
        $user->address = $request->address;
        $user->save();
        return redirect('/view-users');
    }
}