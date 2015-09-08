<?php

namespace App\Repositories\Card;

use App\Model\Card\MassMessage;
use App\Repositories\BaseRepository;



/**
 *  SmsRepository
 *
 * @author raoyc<youyadaojia@gmail.com>
 */
class SmsRepository extends BaseRepository
{

    /**
     * The Card instance.
     *
     * @var App\Model\Card\MassMessage
     */
    protected $sms;

    /**
     * Create a new ContentRepository instance.
     *
     * @param  App\Model\Card\MassMessage $card
     * @return void
     */
    public function __construct(MassMessage $sms)
    {
        $this->sms = $sms;

    }

    /**
     * 创建或更新内容
     *
     * @param  App\Model\Card\MassMessage $sms
     * @param  array $inputs
     * @param  string|int $user_id
     * @return App\Model\MassMessage
     */
    private function saveCity($sms, $inputs,  $user_id = '1')
    {
        $setting = [
            'delimiter' => '',
            'accent' => false,
        ];

        $sms->name   = e($inputs['name']);
        $sms->pid   = e($inputs['pid']);

        if (array_key_exists('status', $inputs)) {
            $sms->status = e($inputs['status']);
        }

        $sms->save();

        return $sms;
    }


    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 内容资源列表数据
     */
    public function index()
    {
        $cards = $this->card->all();


        return $cards;

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
