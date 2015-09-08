<?php

namespace App\Repositories;

use App\Model\Product;
use App\Model\Sort;


/**
 * 内容仓库ContentRepository
 *
 * @author raoyc<youyadaojia@gmail.com>
 */
class ProductRepository extends BaseRepository
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
     * @param  App\Model\Product $product
     * @param  array $inputs
     * @param  string $type
     * @param  string|int $user_id
     * @return App\Model\Product
     */
    private function saveProduct($product, $inputs,  $user_id = '1')
    {
        $product->name   = e($inputs['name']);
        $product->body = e($inputs['body']);
        $product->thumb   = e($inputs['thumb']);
        $product->sort   = e($inputs['sort']);
        $product->price   = e($inputs['price']);
        $product->spec   = e($inputs['spec']);


        if (array_key_exists('status', $inputs)) {
            $product->status = e($inputs['status']);
        }

        if ($user_id) {
            $product->ad_id = $user_id;
        }

        $product->save();

        return $product;
    }


    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 内容资源列表数据
     */
    public function index()
    {
        $products = $this->product->all();
        return $products;
    }

    /**
     * 存储内容
     *
     * @param  array $inputs
     * @param  string|int $user_id 管理用户id
     * @return App\Model\Product
     */
    public function store($inputs,$user_id = '1')
    {
        $product = new $this->product;

        $product = $this->saveProduct($product, $inputs, $user_id);
        return $product;
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
        $product = $this->product->findOrFail($id);

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

        $product = $this->product->findOrFail($id);
        $product = $this->saveProduct($product, $inputs);

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

        $product = $this->product->findOrFail($id);
        $product->delete();
    }
    #********
    #* 资源 REST 相关的接口函数 END
    #********
}
