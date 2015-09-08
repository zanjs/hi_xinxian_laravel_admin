<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;


use App\Model\Card\UserCa;
use App\Model\Card\Order;
use App\Model\Card\MixOrder;
use App\Model\Card\Recharge;
use App\Model\Card\Market;

class DataReportController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $day = getWeekDate();

        $cardAr = [];
        $orderAr = [];
        $rechargeAr = [];
        foreach($day as $day){
            $cardAr[] = UserCa::where('created_at','<',$day.' 23:59:59')->count();
            /* 订单金额 */
            $orders = Order::where('created_at','<',$day.' 23:59:59')->get();
            $orderPrice = 0;
            foreach($orders as $order){
                $orderPrice += $order->price;
            }
            $orderAr[] = $orderPrice;
            /* 混合订单金额 */
            $mixOrders = MixOrder::where('created_at','<',$day.' 23:59:59')->get();
            $mixOrderPrice = 0;
            foreach($mixOrders as $order){
                $mixOrderPrice += $order->price;
            }
            $mixOrderAr[] = $mixOrderPrice;
            /* 充值金额 */
            $recharges = Recharge::where('created_at','<',$day.' 23:59:59')->get();
            $rechargePrice = 0;
            foreach($recharges as $d){
                $rechargePrice += $d->price;
            }
            $rechargeAr[] = $rechargePrice;

        }


        $data['cards'] = $cardAr;
        $data['orderPrice'] = $orderAr;
        $data['mixOrderPrice'] = $mixOrderAr;
        $data['rechargePrice'] = $rechargeAr;

        $markets = Market::all();
        $data['markets'] = $markets;
        return view('card.data.index',$data);
    }
    /*
     * 每个市场的总报表统计
     * */
    public function show($id)
    {

        $marketAc = Market::find($id);
        if(count($marketAc) < 1){
            abort(404);
        }
        $day = getWeekDate();

        $cardAr = [];
        $orderAr = [];
        $rechargeAr = [];
        foreach($day as $day){
            $cardAr[] = UserCa::where('market_id',$id)->where('created_at','<',$day.' 23:59:59')->count();
            /* 订单金额 */
            $orders = Order::where('market_id',$id)->where('created_at','<',$day.' 23:59:59')->get();
            $orderPrice = 0;
            foreach($orders as $order){
                $orderPrice += $order->price;
            }
            $orderAr[] = $orderPrice;
            /* 混合订单金额 */
            $mixOrders = MixOrder::where('market_id',$id)->where('created_at','<',$day.' 23:59:59')->get();
            $mixOrderPrice = 0;
            foreach($mixOrders as $order){
                $mixOrderPrice += $order->price;
            }
            $mixOrderAr[] = $mixOrderPrice;
            /* 充值金额 */
            $recharges = Recharge::where('market_id',$id)->where('created_at','<',$day.' 23:59:59')->get();
            $rechargePrice = 0;
            foreach($recharges as $d){
                $rechargePrice += $d->price;
            }
            $rechargeAr[] = $rechargePrice;

        }

        $data['cards'] = $cardAr;
        $data['orderPrice'] = $orderAr;
        $data['mixOrderPrice'] = $mixOrderAr;
        $data['rechargePrice'] = $rechargeAr;

        $markets = Market::all();

        $data['markets'] = $markets;
        $data['marketAc'] = $marketAc;

        return view('card.data.show',$data);
    }





}
