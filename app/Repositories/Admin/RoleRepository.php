<?php namespace App\Repositories\Admin;

use App\Model\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository {
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Get role list
     * @param $perPage
     * @return mixed
     */
    public function index()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }
    /**
     * Get role list
     * @param $perPage
     * @return mixed
     */
    public function roleList()
    {
        //return $this->model->orderBy('id', 'desc')->paginate($perPage);
        return $this->model->orderBy('id', 'desc')->get();
    }
    /**
     * Store role
     * @param $inputs
     * @return mixed
     */
    public function store($inputs,$user_id = '1')
    {
        $model = new $this->model;
        $model->name = $inputs['name'];
        $model->display_name = $inputs['display_name'];
        $model->description = $inputs['description'];
        return $model->save();
    }

    /**
     * Save role's permissions
     * @param $id
     * @param array $perms
     * @return mixed
     */
    public function savePerms($id, $perms = [])
    {
        $role = $this->getById($id);
        return $role->perms()->sync($perms);
    }

    /**
     * Get role's permissions
     * @param $id
     * @return array
     */
    public function rolePerms($id)
    {
        $perms = [];
        $permissions = $this->getById($id)->perms()->get();

        foreach ($permissions as $item) {
            $perms[$item->id] = $item->name;
        }

        return $perms;
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
     * Update Role
     * @param $id
     * @param $inputs
     */
    public function update($id, $inputs)
    {
        $data = [];
        $data['display_name'] = $inputs['display_name'];
        $data['description'] = $inputs['description'];
        $result = $this->model->where('id', $id)->update($data);
        if (!$result) {
            return [
                'status' => false,
                'error' => '角色更新失败'
            ];
        }

        return ['status' => true];
    }

    /**
     * Destroy role by id
     * @param int $id
     * @return bool|null
     */
    public function destroy($id)
    {
        $role = $this->model->find($id);
        if(!$role){
            return false;
        }
        $role->users()->detach();
        return $role->delete();
    }

}