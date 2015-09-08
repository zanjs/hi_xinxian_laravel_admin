<?php

namespace App\Repositories\Card;

use App\Model\Card\UserCa;
use App\Repositories\BaseRepository;



/**
 *  CardRepository
 *
 * @author raoyc<youyadaojia@gmail.com>
 */
class CardRepository extends BaseRepository
{

    /**
     * The Card instance.
     *
     * @var App\Model\Card\UserCa
     */
    protected $card;

    /**
     * Create a new ContentRepository instance.
     *
     * @param  App\Model\Card\UserCa $card
     * @return void
     */
    public function __construct(UserCa $card)
    {
        $this->card = $card;

    }

    /**
     * 创建或更新内容
     *
     * @param  App\Model\Card\UserCa $card
     * @param  array $inputs
     * @param  string|int $user_id
     * @return App\Model\UserCa
     */
    private function saveModel($card, $inputs,  $user_id = '1')
    {
        $setting = [
            'delimiter' => '',
            'accent' => false,
        ];

        $card->card   = e($inputs['card']);
        $card->name   = e($inputs['name']);
        $card->phone   = e($inputs['phone']);
        $card->price   = e($inputs['price']);
        $card->price_x   = e($inputs['price_x']);
        $card->sex   = e($inputs['sex']);
        $card->market_id   = e($inputs['market_id']);

        /*if (array_key_exists('status', $inputs)) {
            $card->status = e($inputs['status']);
        }*/

        $card->save();

        return $card;
    }


    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 内容资源列表数据
     */
    public function index()
    {
        $cards = $this->card->orderBy('created_at', 'desc')->paginate(200);
       // $cards = City::with('childrenCities')->get();
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
        $city = new $this->card;
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
        $card = $this->card->findOrFail($id);
        return $card;
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

        $card = $this->card->findOrFail($id);
        $card = $this->saveModel($card, $inputs);

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

        $card = $this->card->findOrFail($id);
        $card->delete();
    }
    #********
    #* 资源 REST 相关的接口函数 END
    #********
}
