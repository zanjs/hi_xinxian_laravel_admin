<?php

namespace App\Repositories;

use App\Model\Merchant;


/**
 * 内容仓库MerchantRepository
 *
 * @author raoyc<youyadaojia@gmail.com>
 */
class MerchantRepository extends BaseRepository
{

    /**
     * The Meta instance.
     *
     * @var App\Model\Merchant
     */
    protected $merchant;

    /**
     * Create a new MerchantRepository instance.
     *
     * @param  App\Model\Merchant $merchant
     * @return void
     */
    public function __construct(Merchant $merchant)
    {
        $this->merchant = $merchant;

    }



    /**
     * 创建或更新内容
     *
     * @param  App\Model\Merchant $merchant
     * @param  array $inputs
     * @param  string $type
     * @param  string|int $user_id
     * @return App\Model\Merchant
     */
    private function saveMerchant($merchant, $inputs,  $user_id = '1')
    {
        $merchant->name   = e($inputs['name']);
        $merchant->mobile = e($inputs['mobile']);
        $merchant->dist_name   = e($inputs['dist_name']);
        $merchant->fare   = e($inputs['fare']);
        $merchant->full_price   = e($inputs['full_price']);
        $merchant->city   = e($inputs['city']);
        $merchant->address   = e($inputs['address']);
        $merchant->gps_x   = e($inputs['gps_x']);
        $merchant->gps_y   = e($inputs['gps_y']);
        $merchant->printer_key   = e($inputs['printer_key']);
        $merchant->printer_code   = e($inputs['printer_code']);
        $merchant->printer_id   = e($inputs['printer_id']);
        $merchant->printer_mobile   = e($inputs['printer_mobile']);

        if (array_key_exists('status', $inputs)) {
            $merchant->status = e($inputs['status']);
        }

        $merchant->save();

        return $merchant;
    }


    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 内容资源列表数据
     */
    public function index()
    {
        $merchants = $this->merchant->all();
        return $merchants;
    }

    /**
     * 存储内容
     *
     * @param  array $inputs
     * @param  string|int $user_id 管理用户id
     * @return App\Model\Merchant
     */
    public function store($inputs,$user_id = '1')
    {
        $merchant = new $this->merchant;

        $merchant = $this->saveMerchant($merchant, $inputs, $user_id);
        return $merchant;
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
        $merchant = $this->merchant->findOrFail($id);

        return $merchant;
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

        $merchant = $this->merchant->findOrFail($id);
        $merchant = $this->saveMerchant($merchant, $inputs);

    }

    /**
     * 删除内容
     *
     * @param  int $id
     * @param  string $type 内容模型类型
     * @return void
     */
    public function destroy($id)    {

        $merchant = $this->merchant->findOrFail($id);
        $merchant->delete();
    }
    #********
    #* 资源 REST 相关的接口函数 END
    #********
}
