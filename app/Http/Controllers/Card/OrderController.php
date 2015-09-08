<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Model\Card\Order;

class OrderController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = Order::orderBy('id','desc')->simplePaginate(200);
        $data["orders"] = $orders;
        return view('card.order.index',$data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $order -> goods =  json_decode($order->product_json);
        $data['data'] = $order;
        return view('card.order.show',$data);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('card.order.index')->with('message', '删除成功！');
    }
}
