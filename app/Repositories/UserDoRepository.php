<?php

namespace App\Repositories;


use App\Model\UserDo;


/**
 * 用户仓库 UserDoRepository
 *
 * @author raoyc<youyadaojia@gmail.com>
 */
class UserDoRepository extends BaseRepository
{

    /**
     * The Meta instance.
     *
     * @var App\Model\UserDo
     */
    protected $userDo;

    /**
     * Create a new ContentRepository instance.
     *
     * @param  App\Model\UserDo $product
     * @return void
     */
    public function __construct(UserDo $userDo)
    {
        $this->userDo = $userDo;

    }

    /**
     * 创建或更新内容
     *
     * @param  App\Model\UserDo $product
     * @param  array $inputs
     * @return App\Model\UserDo
     */
    private function saveSort($userDo, $inputs,  $user_id = '1')
    {
        $userDo->name   = e($inputs['name']);
        $userDo->thumb   = e($inputs['thumb']);

        if (array_key_exists('status', $inputs)) {
            $userDo->status = e($inputs['status']);
        }

        $userDo->save();

        return $userDo;
    }


    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 内容资源列表数据
     */
    public function index()
    {
        $sort = $this->userDo->all();
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
        $sort = new $this->userDo;
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
        $product = $this->userDo->findOrFail($id);
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

        $sort = $this->userDo->findOrFail($id);
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

        $product = $this->userDo->findOrFail($id);
        $product->delete();
    }
    #********
    #* 资源 REST 相关的接口函数 END
    #********
}
