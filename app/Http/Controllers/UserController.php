<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //个人设置页面
    public function setting()
    {

        return view('user.setting');
    }

    //个人设置操作
    public function settingStore()
    {

    }

    //个人中心
    public function show(User $user)
    {
        //个人信息，关注，粉丝，文章数
        $user = User::withCount(['stars', 'fans', 'posts'])->find($user->id);

        //文章列表，创建时间前十条
        $posts = $user->posts()->orderBy('created_at', 'desc')->take(10)->get();

        //关注用户，关注用户的关注数，粉丝数，文章数
        $stars = $user->stars;
        $susers = User::whereIn('id', $stars->pluck('star_id'))->withCount(['stars', 'fans', 'posts'])->get();

        //粉丝用户，粉丝用户的关注数，粉丝数，文章数
        $fans = $user->fans;
        $fusers = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['stars', 'fans', 'posts'])->get();


        return view('user/show', compact('user', 'posts', 'susers', 'fusers'));
    }

    public function fan(User $user)
    {
        $me = \Auth::user();
        \App\Fan::firstOrCreate(['fan_id' => $me->id, 'star_id' => $user->id]);
        return [
            'error' => 0,
            'msg' => 'ok',
        ];
    }

    public function unfan(User $user)
    {
        $me = \Auth::user();
        \App\Fan::where('fan_id', $me->id)->where('star_id', $user->id)->delete();
        return [
            'error' => 0,
            'msg' => 'ok',
        ];
    }
}
