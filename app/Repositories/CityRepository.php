<?php

namespace App\Repositories;

use App\Model\Product;
use App\Model\City;


/**
 * 分类仓库CityRepository
 *
 * @author raoyc<youyadaojia@gmail.com>
 */
class CityRepository extends BaseRepository
{

    /**
     * The Meta instance.
     *
     * @var App\Model\City
     */
    protected $city;

    /**
     * Create a new ContentRepository instance.
     *
     * @param  App\Model\City $product
     * @return void
     */
    public function __construct(City $city)
    {
        $this->city = $city;

    }

    /**
     * 创建或更新内容
     *
     * @param  App\Model\City $product
     * @param  array $inputs
     * @param  string $type
     * @param  string|int $user_id
     * @return App\Model\City
     */
    private function saveCity($city, $inputs,  $user_id = '1')
    {
        $setting = [
            'delimiter' => '',
            'accent' => false,
        ];

        //$city->tag =  Pinyin::trans(e($inputs['name']), $setting);

        $city->name   = e($inputs['name']);
        $city->pid   = e($inputs['pid']);

        if (array_key_exists('status', $inputs)) {
            $city->status = e($inputs['status']);
        }

        $city->save();

        return $city;
    }


    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 内容资源列表数据
     */
    public function index()
    {
        //$city = $this->city->all();
        $city = City::with('childrenCities')->get();
        $cities = $city->each(function($c)
        {
            if($c->pid == 0){
                $c->pname = "顶级城市";
            }else{
                $p_name = $this->city->findOrFail($c->pid)->name;
               /* $s_ = '----';
                $c->name = $s_.$c->name;*/
                $c->pname = $p_name;
            }
        });

        return $cities;

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
        $city = new $this->city;
        $city = $this->saveCity($city, $inputs, $user_id);
        return $city;
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

        $city = $this->city->findOrFail($id);
        $city = $this->saveCity($city, $inputs);

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

        $city = $this->city->findOrFail($id);
        $city->delete();
    }
    #********
    #* 资源 REST 相关的接口函数 END
    #********
}
