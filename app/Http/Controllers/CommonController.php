<?php

namespace App\Http\Controllers;

/**
 * 前后台共用控制器
 * CommonController
 *
 * @author raoyc <youyadaojia@gmail.com>
 */
class CommonController extends Controller
{

    const PER_PAGE_NUM = 20;
    public function __construct()
    {
        $this->middleware('auth.admin');
    }
}
