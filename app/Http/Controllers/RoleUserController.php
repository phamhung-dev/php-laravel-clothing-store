<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function index(){
        $roleUsers = RoleUser::with('User')
        ->with('Role')
        ->get();
        return view('admin.role.list', compact('roleUsers'));
    }
    public function showFormCreate(){
        $users = User::all();
        $roles = Role::all();
        return view('admin.role.create', compact('users','roles'));
    }
    public function store(Request $request){
        try {
            RoleUser::create($request->all());
        } catch (\Exception $err) {
            return back()->withError('Role of admin has exit')->withInput();
        }
       return redirect()->route('admin.role');
    }
    public function destroy($user_id, $role_id)
    {
        try {
            RoleUser::where('user_id', $user_id)
            ->where('role_id', $role_id)
            ->delete();
        } catch (ModelNotFoundException $err) {
            return back()->withError($err->getMessage())->withInput();
        }
        return redirect()
            ->route('admin.role')
            ->with('success','Role deleted');
    }
}
