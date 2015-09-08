<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;

use App\Model\Card\CashOrder;

class CashOrderController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = CashOrder::orderBy('id','desc')->simplePaginate(200);
        $data["orders"] = $orders;
        return view('card.cash_order.index',$data);
    }

    public function show($id)
    {
        $order = CashOrder::find($id);
        $order -> goods =  json_decode($order->product_json);
        $data['data'] = $order;
        return view('card.cash_order.show',$data);
    }

    public function destroy($id)
    {
        $order = CashOrder::findOrFail($id);
        $order->delete();
        return redirect()->route('card.cash_order.index')->with('message', '删除成功！');
    }
}
