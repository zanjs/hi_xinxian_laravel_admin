<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Card\CountOrder;

class OrderCountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = CountOrder::orderBy('id','desc')->simplePaginate(200);
        $data["orders"] = $orders;
        return view('card.count.order',$data);
    }

    public function destroy($id)
    {
        $order = CountOrder::findOrFail($id);
        $order->delete();
        return redirect()->route('card.order_count.index')->with('message', '删除成功！');
    }
}
