<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CityRequest; //请求层
use App\Repositories\CityRepository;  //模型仓库层

class AdminCityController extends AdminController
{
    protected $city;

    public function __construct(CityRepository $city)
    {
        parent::__construct();
        $this->city = $city;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cities = $this->city->index();
        //print($cities);
        $data['cities'] = $cities;
        return view('admin.city.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cities = $this->city->index();
        $data['cities'] = $cities;

        return view('admin.city.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CityRequest $request)
    {
        $postData = $request->all();  //获取请求过来的数据
        $user = $request->user();
        $city = $this->city->store($postData,$user->id);  //使用仓库方法存储
        if ($city->id) {  //添加成功
            return redirect()->route('admin.city.index')->with('message', '添加分类成功！');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $city = $this->city->edit($id);
        $cities = $this->city->index();
        $data['cities'] = $cities;
        $data['data'] = $city;
        return view('admin.city.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(CityRequest $request, $id)
    {
        $postData = $request->all();  //获取请求过来的数据
        $this->city->update($id,$postData);  //使用仓库方法存储
        return redirect()->route('admin.city.index')->with('message', '修改成功！');
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
