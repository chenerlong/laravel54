<?php
/**
 * Created by 20.
 * User: 20
 * Date: 2018/7/15
 * Time: 下午 16:38:35
 */
namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

//默认 posts 表
class Model extends BaseModel
{
    //不可注入
    protected $guarded = [];

    //可注入
//    protected $fillable = [
//        'title',
//        'content',
//    ];
}