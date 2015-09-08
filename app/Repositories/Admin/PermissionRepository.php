<?php namespace App\Repositories\Admin;

use App\Model\Permission;
use App\Repositories\BaseRepository;
class PermissionRepository extends BaseRepository {

    protected $model;

    /**
     * Create a new ContentRepository instance.
     *
     * @param  App\Model\City $product
     * @return void
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }


    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 内容资源列表数据
     */
    public function index()
    {
        return $this->model->orderBy('id','desc')->get();

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
        $model->name = e($inputs['name']);
        $model->display_name = e($inputs['display_name']);
        $model->description = e($inputs['description']);
        return $model->save();
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
        $city = $this->city->findOrFail($id);
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

        $isAble = $this->model->where('id', '<>', $id)->where('name', $inputs['name'])->count();
        if ($isAble) {
            return [
                'status' => false,
                'error' => '权限名已被使用'
            ];
        }

        $data = [];
        $data['name'] = $inputs['name'];
        $data['display_name'] = $inputs['display_name'];
        $data['description'] = $inputs['description'];
        $result = $this->model->where('id', $id)->update($data);
        if (!$result) {
            return [
                'status' => false,
                'error' => '权限更新失败'
            ];
        }

        return ['status' => true];

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

        $permission = $this->model->find($id);
        if(!$permission){
            return false;
        }
        $permission->roles()->detach();
        return $permission->delete();
    }
    #********
    #* 资源 REST 相关的接口函数 END
    #********
}