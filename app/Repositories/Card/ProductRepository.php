<?php

namespace App\Repositories\Card;

use App\Model\Card\Product;
use App\Repositories\BaseRepository;



/**
 *  ProductRepository
 *
 * @author raoyc<youyadaojia@gmail.com>
 */
class ProductRepository extends BaseRepository
{

    /**
     * The Card instance.
     *
     * @var App\Model\Card\Product
     */
    protected $model;

    /**
     * Create a new ContentRepository instance.
     *
     * @param  App\Model\Card\Product $card
     * @return void
     */
    public function __construct(Product $model)
    {
        $this->model = $model;

    }

    /**
     * 创建或更新内容
     *
     * @param  App\Model\Card\Product $card
     * @param  array $inputs
     * @param  string|int $user_id
     * @return App\Model\Product
     */
    private function saveData($model, $inputs,  $user_id = '1')
    {
        $setting = [
            'delimiter' => '',
            'accent' => false,
        ];

        $model->name   = e($inputs['name']);
        $model->price   = e($inputs['price']);
        $model->b_price   = e($inputs['b_price']);
        $model->no   = e($inputs['no']);
        $model->number   = e($inputs['number']);
        $model->market_id   = e($inputs['market_id']);

        if (array_key_exists('status', $inputs)) {
            $model->status = e($inputs['status']);
        }

        $model->save();

        return $model;
    }


    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 内容资源列表数据
     */
    public function index()
    {
        $model = $this->model->orderBy('created_at', 'desc')->paginate(200);
        // $cards = City::with('childrenCities')->get();

        return $model;

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
        $model = new $this->model;
        $model = $this->saveData($model, $inputs, $user_id);
        return $model;
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
        $city = $this->model->findOrFail($id);
        return $city;
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
        $model = $this->model->findOrFail($id);
        $model = $this->saveData($model, $inputs);
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
        $model = $this->model->findOrFail($id);
        $model->delete();
    }
    #********
    #* 资源 REST 相关的接口函数 END
    #********
}
