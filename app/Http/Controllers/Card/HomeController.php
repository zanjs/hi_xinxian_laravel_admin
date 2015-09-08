<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Card\UserCa;
use App\Model\Card\Order;

use App\Model\Card\CountOrder;
use App\Model\Card\Recharge;

class HomeController extends Controller
{
    /**
     * 后台首页 === 后台控制台概要页面
     *
     * @return Response
     */
    public function index()
    {
        $startTime = date('Y-m-d',time()).' 00:00:00';
        $endTime = date('Y-m-d',time()).' 23:59:59';
        $data['cards'] = UserCa::whereBetween('created_at',[$startTime,$endTime])->get()->count();
        $data['orders'] = Order::whereBetween('created_at',[$startTime,$endTime])->get()->count();
        $recharges = Recharge::whereBetween('created_at',[$startTime,$endTime])->get();
        $consumes = CountOrder::whereBetween('created_at',[$startTime,$endTime])->get();
        $rechargesPrice = 0;
        $consumesPrice = 0;
        if(count($recharges) > 0){

           foreach($recharges as $key => $li){
               $rechargesPrice += $li-> price;
           }

        }
        if(count($consumes) >0){
            foreach($consumes as $key => $li){
                $consumesPrice += $li-> product_price*$li-> product_weight;
            }
        }
        $data['rechargesPrice'] = $rechargesPrice;
        $data['consumesPrice'] = $consumesPrice;

        return view('card.home.index',$data);
    }


}
