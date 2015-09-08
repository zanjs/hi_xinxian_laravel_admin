<?php

namespace App\Repositories;


use App\Model\Order;
use App\Model\Merchant;


/**
 * 分类仓库ContentRepository
 *
 * @author raoyc<youyadaojia@gmail.com>
 */
class OrderRepository extends BaseRepository
{

    /**
     * The Meta instance.
     *
     * @var App\Model\Order
     */
    protected $order;

    /**
     * Create a new OrderRepository instance.
     *
     * @param  App\Model\Order $order

     * @return void
     */
    public function __construct( Order $order,Merchant $merchant)
    {
        $this->order = $order;
        $this->merchant = $merchant;

    }

    /**
     * 创建或更新内容
     *
     * @param  App\Model\Order $product
     * @param  array $inputs
     * @param  string $type
     * @param  string|int $user_id
     * @return App\Model\Order
     */
    private function saveSort($sort, $inputs,  $user_id = '1')
    {
        $sort->name   = e($inputs['name']);
        $sort->thumb   = e($inputs['thumb']);

        if (array_key_exists('status', $inputs)) {
            $sort->status = e($inputs['status']);
        }

        $sort->save();

        return $sort;
    }


    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 内容资源列表数据
     */
    public function index()
    {
        $order = $this->order->all();
        return $order;
    }

    /**
     * 存储内容
     *
     * @param  array $inputs
     * @param  string|int $user_id 管理用户id
     * @return App\Model\Sort
     */
    public function store($inputs,$user_id = '1')
    {
        $sort = new $this->sort;
        $sort = $this->saveSort($sort, $inputs, $user_id);
        return $sort;
    }

    /**
     * 获取编辑的内容
     *
     * @param  int $id
     * @param  string $type 内容模型类型
     * @return Illuminate\Support\Collection
     */
    public function edit($id)
    {
        $product = $this->sort->findOrFail($id);
        return $product;
    }

    /**
     * 显示订单内容
     *
     * @param  int $id
     * @param  string $type 内容模型类型
     * @return Illuminate\Support\Collection
     */
    public function show($id)
    {
        $order = $this->order->findOrFail($id);
        $order -> merchant =  $this->merchant->findOrFail($order->merchant_id);
        $order -> goods =  json_decode($order->product_json);
        return $order;
    }

    /**
     * 更新内容
     *
     * @param  int $id
     * @param  array $inputs
     * @param  string $type 内容模型类型
     * @return void
     */
    public function update($id, $inputs)
    {

        $sort = $this->sort->findOrFail($id);
        $sort = $this->saveSort($sort, $inputs);

    }

    /**
     * 删除内容
     *
     * @param  int $id
     * @param  string $type 内容模型类型
     * @return void
     */
    public function destroy($id)
    {

        $product = $this->sort->findOrFail($id);
        $product->delete();
    }
    #********
    #* 资源 REST 相关的接口函数 END
    #********
}
