<?php

namespace App\Repositories\Card;


use App\Repositories\BaseRepository;

use App\Model\Card\Operator;


/**
 *  OperatorRepository
 *
 * @author raoyc<youyadaojia@gmail.com>
 */
class OperatorRepository extends BaseRepository
{

    /**
     * The Market instance.
     *
     * @var App\Model\Card\Operator
     */
    protected $model;


    /**
     * Create a new MarketRepository instance.
     *
     * @param  App\Model\Card\Operator $model
     * @return void
     */
    public function __construct(Operator $model)
    {
        $this->model = $model;


    }

    /**
     * 创建或更新内容
     *
     * @param  App\Model\Card\Operator $card
     * @param  array $inputs
     * @param  string|int $user_id
     * @return App\Model\Operator
     */
    private function saveData($model, $inputs,  $user_id = '1')
    {
        $model->name   = e($inputs['name']);
        $model->phone   = e($inputs['phone']);
        $model->email   = e($inputs['email']);

        if(e($inputs['password']) != ''){
            $model->password   = bcrypt(e($inputs['password']));
        };
        $model->login_name   = e($inputs['login_name']);
        $model->market_id   = e($inputs['market_id']);
        $model->safety_key   = e($inputs['safety_key']);

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
        $model = $this->model->all();
        // $cards = City::with('childrenCities')->get();

        return $model;

    }

    /**
     * 存储内容
     *
     * @param  array $inputs
     * @param  string|int $user_id 管理用户id     *
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
        $model = $this->model->findOrFail($id);
        return $model;
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
