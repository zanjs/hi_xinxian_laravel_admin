<?php

namespace App\Repositories;

use App\Model\Product;
use App\Model\Sort;


/**
 * 分类仓库ContentRepository
 *
 * @author raoyc<youyadaojia@gmail.com>
 */
class SortRepository extends BaseRepository
{

    /**
     * The Meta instance.
     *
     * @var App\Model\Sort
     */
    protected $sort;

    /**
     * Create a new ContentRepository instance.
     *
     * @param  App\Model\Product $product
     * @param  App\Model\Sort $sort
     * @return void
     */
    public function __construct(
        Product $product,
        Sort $sort)
    {
        $this->product = $product;
        $this->sort = $sort;
    }



    /**
     * 获取所有Sort元数据
     *
     * @param  string $type 元模型类型 分类category,标签tag
     * @return Illuminate\Support\Collection
     */
    public function sort()
    {
        $sort = $this->sort->get();
        return $sort;
    }


    /**
     * 创建或更新内容
     *
     * @param  App\Model\Sort $product
     * @param  array $inputs
     * @param  string $type
     * @param  string|int $user_id
     * @return App\Model\Sort
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
        $sort = $this->sort->all();
        return $sort;
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
