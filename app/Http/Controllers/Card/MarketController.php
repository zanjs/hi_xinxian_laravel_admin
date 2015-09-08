<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Requests\Card\MarketRequest; //请求层
use App\Repositories\Card\MarketRepository;  //模型仓库层

class MarketController extends AdminController
{
    protected $market;

    public function __construct(MarketRepository $market)
    {
        parent::__construct();
        $this->market = $market;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $markets = $this->market->index();
        $data['markets'] = $markets;

        return view('card.market.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('card.market.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(MarketRequest $request)
    {
        $postData = $request->all();  //获取请求过来的数据
        $user = $request->user();

        $model = $this->market->store($postData,$user->id);  //使用仓库方法存储
        if ($model->id) {  //添加成功
            return redirect()->route('card.market.index')->with('message', '成功提交！');
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
        $model = $this->market->edit($id);
        $data['data'] = $model;
        return view('card.market.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(MarketRequest $request, $id)
    {
        $postData = $request->all();  //获取请求过来的数据
        $this->market->update($id,$postData);  //使用仓库方法存储
        return redirect()->route('card.market.index')->with('message', '修改成功！');
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
