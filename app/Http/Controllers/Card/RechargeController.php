<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;

use App\Model\Card\Recharge;

class RechargeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $recharges = Recharge::orderBy('id','desc')->simplePaginate(200);
        $data['recharges'] = $recharges;


        return view('card.record.recharge',$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $card = Recharge::findOrFail($id);
        $card->delete();
        return redirect()->route('card.recharge.index')->with('message', '删除成功！');
    }
}
