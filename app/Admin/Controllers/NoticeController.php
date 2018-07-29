<?php

namespace App\Admin\Controllers;

use \App\Notice;

class NoticeController extends Controller
{

    public function index()
    {
        $notices = \App\Notice::all();
        return view('admin/notice/index', compact('notices'));
    }

    public function create()
    {
        return view('/admin/notice/create');
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|min:3',
            'content' => 'required|min:3'
        ]);

        $notice = \App\Notice::create(request(['title', 'content']));

        dispatch(new \App\Jobs\SendMessage($notice));

        return redirect('/admin/notices');
    }

}