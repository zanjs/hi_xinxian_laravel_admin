<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminHomeController extends AdminController
{
    /**
     * 后台首页 === 后台控制台概要页面
     *
     * @return Response
     */
    public function index()
    {


        return view('admin.home');
    }


}
