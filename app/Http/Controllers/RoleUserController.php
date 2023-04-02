<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
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
}
