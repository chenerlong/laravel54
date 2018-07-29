<?php

namespace App\Admin\Controllers;

use \App\AdminUser;

class UserController extends Controller
{
    //管理员列表页
    public function index()
    {
        $users = AdminUser::paginate(10);
        return view('/admin/user/index', compact('users'));
    }

    //管理员创建页
    public function create()
    {
        return view('/admin/user/create');
    }

    //创建操作
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'password' => 'required',
        ]);

        $name = request('name');
        $password = bcrypt(request('password'));
        AdminUser::create(compact('name', 'password'));

        return redirect('/admin/users');
    }

    //用户的角色页面
    public function role(AdminUser $user)
    {
        $roles = \App\AdminRole::all();
        $myRoles = $user->roles;

        return view('admin.user.role', compact('roles', 'myRoles', 'user'));
    }

    //存储用户角色
    public function storeRole(\App\AdminUser $user)
    {
        $this->validate(request(), [
            'roles' => 'required|array'
        ]);

        $roles = \App\AdminRole::findMany(request('roles'));
        $myRoles = $user->roles;

        //add
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $addRole) {
            $user->assignRole($addRole);
        }

        //delete
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $deleteRole) {
            $user->deleteRole($deleteRole);
        }

        return back();
    }
}