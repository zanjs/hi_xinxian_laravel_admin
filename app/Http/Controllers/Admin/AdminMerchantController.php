<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\MerchantRequest; //请求层
use App\Repositories\MerchantRepository;  //模型仓库层

class AdminMerchantController extends AdminController
{
    protected $merchant;

    public function __construct(MerchantRepository $merchant)
    {
        parent::__construct();
        $this->merchant = $merchant;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $merchants = $this->merchant->index();
        $data['merchants'] = $merchants;
        return view('admin.merchant.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.merchant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(MerchantRequest $request)
    {
        $postData = $request->all();  //获取请求过来的数据
        $user = $request->user();
        $merchant = $this->merchant->store($postData,$user->id);  //使用仓库方法存储
        if ($merchant->id) {  //添加成功
            return redirect()->route('admin.merchant.index')->with('message', '添加成功！');
        } else {  //添加失败
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $merchant= $this->merchant->edit($id);
        $data['data'] = $merchant;
        return view('admin.merchant.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(MerchantRequest $request, $id)
    {
        $postData = $request->all();  //获取请求过来的数据
        $this->merchant->update($id, $postData);
        return redirect()->route('admin.merchant.index')->with('message', '修改成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
