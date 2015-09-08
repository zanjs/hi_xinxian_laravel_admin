<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Admin\AdminController;
use App\Model\Card\MixOrder;

class MixOrderController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = MixOrder::orderBy('id','desc')->get();
        $data["orders"] = $orders;
        return view('card.mix_order.index',$data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $order = MixOrder::find($id);
        $order -> goods =  json_decode($order->product_json);
        $data['data'] = $order;
        return view('card.mix_order.show',$data);
    }

    public function destroy($id)
    {
        $order = MixOrder::findOrFail($id);
        $order->delete();
        return redirect()->route('card.mix_order.index')->with('message', '删除成功！');
    }

}
