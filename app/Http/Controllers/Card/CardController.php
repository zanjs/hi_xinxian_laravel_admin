<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;

use App\Repositories\Card\CardRepository;  //模型仓库层
use App\Http\Requests\Card\CardRequest; //请求层


use App\Model\Card\Market;

class CardController extends AdminController
{

    protected $card;

    public function __construct(CardRepository $card)
    {
        parent::__construct();
        $this->card = $card;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cards = $this->card->index();
        $data['cards'] = $cards;

        return view('card.card.index',$data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $card = $this->card->edit($id);
        $data['markets'] = Market::all();
        $data['data'] = $card;
        return view('card.card.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(CardRequest $request, $id)
    {
        $postData = $request->all();  //获取请求过来的数据
        $this->card->update($id,$postData);  //使用仓库方法存储
        return redirect()->route('card.card.index')->with('message', '修改成功！');
    }


    public function destroy($id)
    {
        $cards = $this->card->destroy($id);
        return redirect()->route('card.card.index')->with('message', '删除成功！');
    }
}
