<?php

namespace App\Admin\Controllers;

class LoginController extends Controller
{

    //登陆展示
    public function index()
    {
        return view('admin.login.index');
    }

    //登陆行为
    public function login()
    {
        return ;
    }

    //登出行为
    public function logout()
    {
        return ;
    }
}